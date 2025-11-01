$(function () {
    // === Limite de mots ou caractères ===
    $('.textarea-limit').on('input', function () {
        let $t = $(this);
        let wordLimit = $t.data('word-limit');
        let charLimit = $t.data('character-limit');
        let txt = $t.val();

        if (wordLimit) {
            let words = txt.trim().split(/\s+/);

            if (words.length > wordLimit) {
                $t.val(words.slice(0, wordLimit).join(" "));
            }
        }

        if (charLimit && txt.length > charLimit) {
            $t.val(txt.substring(0, charLimit));
        }
    });

    // Fonction pour mettre à jour toutes les questions dépendantes
    function updateDependentQuestions() {
        $('.question-block[data-belongs-to]').each(function () {
            const $question = $(this);

            // ID de la question parent
            const parentId = String($question.data('belongs-to'));
            if (!parentId) return;

            // Liste des assertions requises (toujours string)
            const rawAssertions = $question.data('assertions');
            const requiredAssertions = rawAssertions
                ? rawAssertions.toString().split(',').map(a => a.trim()).filter(a => a !== '')
                : [];

            // Liste des IDs d'assertions cochées du parent
            const checkedAssertions = $(`.assertion-input[data-question="${parentId}"]:checked`)
                .toArray()
                .map(i => $(i).data('assertion-id').toString()); // 🔥 on utilise data-assertion-id ici

            // Détermine si la question doit apparaître
            const shouldShow = requiredAssertions.length === 0
                ? false
                : requiredAssertions.some(a => checkedAssertions.includes(a.toString()));

            if (shouldShow) {
                $question.stop(true, true).slideDown(200);
            } else {
                $question.stop(true, true).slideUp(200);

                // Nettoie les champs si caché
                $question.find('input[type="text"], input[type="number"], input[type="email"], input[type="tel"], input[type="file"], textarea, select')
                    .val('');
                $question.find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
            }
        });
    }

    // Déclenche la mise à jour à chaque changement d'assertion
    $(document).on('change', '.assertion-input', updateDependentQuestions);

    // Initialisation au chargement (pour questions déjà cochées)
    updateDependentQuestions();
});