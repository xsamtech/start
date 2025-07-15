<?php
/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Notifications Language Lines
    |--------------------------------------------------------------------------
    |
    */

    // ===== ERROR PAGES
    // 400
    '400_title' => 'Mauvaise requête',
    '400_description' => 'Vérifiez votre requête s\'il vous plait !',
    // 401
    '401_title' => 'Non autorisé',
    '401_description' => 'Vous n\'avez pas d\'autorisation<br>pour cette requête.',
    // 403
    '403_title' => 'Espace interdit',
    '403_description' => 'Cet espace n\'est pas permis.',
    // 404
    '404_title' => 'Page non trouvée',
    '404_description' => 'La page que vous cherchez<br>n\'existe pas',
    // 405
    '405_title' => 'Méthode non permise',
    '405_description' => 'Votre requête est envoyée<br>avec une mauvaise méthode.',
    // 419
    '419_title' => 'Page expirée',
    '419_description' => 'La page a mis longtemps sans activité.',
    // 500
    '500_title' => 'Erreur interne',
    '500_description' => 'Notre serveur rencontre un problème.<br>Veuillez réessayez après quelques<br>minutes s\'il vous plait !',
    // Others
    'expects_json' => 'La requête actuelle attend probablement une réponse JSON.',

    // ===== ALERTS
    'no_record' => 'Il n\'y a aucun enregistrement !',
    'find_error' => 'Elément non trouvé !',
    'add_error' => 'L\'ajout a échoué!',
    'create_error' => 'La création a échoué !',
    'update_error' => 'La modification a échoué !',
    'delete_error' => 'Suppression échouée !',
    'added_data' => 'Ajout réussi !',
    'registered_data' => 'Données enregistrées !',
    'updated_data' => 'Données mises à jour !',
    'deleted_data' => 'Elément supprimé !',
    'required_fields' => 'Veuillez vérifier les champs obligatoires',
    'transaction_waiting' => 'Veuillez valider le message de votre opérateur sur votre téléphone. Ensuite appuyez sur le bouton ci-dessous.',
    'transaction_done' => 'Votre opération est terminée !',
    'transaction_failed' => 'L’envoi de votre paiement a échoué',
    'transaction_request_failed' => 'Une erreur lors du traitement de votre requête',
    'transaction_push_failed' => 'Impossible de traiter la demande, veuillez réessayer. Echec envoi du push',
    'transaction_type_error' => 'Veuillez choisir le type de transaction',
    'new_partner_message' => 'Vous pouvez maintenant vous connecter en tant que partenaire avec votre n° de téléphone. Mot de passe temportaire :',
    'attachment_failed' => 'L\'attachement a échoué',
    // Group
    'find_all_groups_success' => 'Groupes trouvés',
    'find_group_success' => 'Groupe trouvé',
    'find_group_404' => 'Groupe non trouvé',
    'create_group_success' => 'Groupe créé',
    'update_group_success' => 'Groupe modifié',
    'delete_group_success' => 'Groupe supprimé',
    // Status
    'find_all_statuses_success' => 'Etats trouvés',
    'find_status_success' => 'Etat trouvé',
    'find_status_404' => 'Etat non trouvé',
    'create_status_success' => 'Etat créé',
    'update_status_success' => 'Etat modifié',
    'delete_status_success' => 'Etat supprimé',
    // Type
    'find_all_types_success' => 'Types trouvés',
    'find_type_success' => 'Type trouvé',
    'find_type_404' => 'Type non trouvé',
    'create_type_success' => 'Type créé',
    'update_type_success' => 'Type modifié',
    'delete_type_success' => 'Type supprimé',
    'type_is_not_file' => 'Le type que vous avez choisi n\'est pas un fichier',
    // Category
    'find_all_categories_success' => 'Catégories trouvées',
    'find_category_success' => 'Catégorie trouvée',
    'find_category_404' => 'Catégorie non trouvée',
    'create_category_success' => 'Catégorie créée',
    'update_category_success' => 'Catégorie modifiée',
    'delete_category_success' => 'Catégorie supprimée',
    // ReportReason
    'find_all_report_reasons_success' => 'Motifs des signalements trouvés',
    'find_report_reason_success' => 'Motif du signalement trouvé',
    'find_report_reason_404' => 'Motif du signalement non trouvé',
    'create_report_reason_success' => 'Motif du signalement créé',
    'update_report_reason_success' => 'Motif du signalement modifié',
    'delete_report_reason_success' => 'Motif du signalement supprimé',
    // Country
    'find_all_countries_success' => 'Pays trouvés',
    'find_country_success' => 'Pays trouvé',
    'find_country_404' => 'Pays non trouvé',
    'create_country_success' => 'Pays créé',
    'update_country_success' => 'Pays modifié',
    'delete_country_success' => 'Pays supprimé',
    // Currency
    'find_all_currencies_success' => 'Devises trouvées',
    'find_currency_success' => 'Devise trouvée',
    'find_currency_404' => 'Devise non trouvée',
    'create_currency_success' => 'Devise créée',
    'update_currency_success' => 'Devise modifiée',
    'delete_currency_success' => 'Devise supprimée',
    // CurrenciesRate
    'find_all_currencies_rates_success' => 'Taux interdevises trouvés',
    'find_currencies_rate_success' => 'Taux interdevises trouvé',
    'find_currencies_rate_404' => 'Taux interdevises non trouvé',
    'create_currencies_rate_success' => 'Taux interdevises créé',
    'update_currencies_rate_success' => 'Taux interdevises modifié',
    'delete_currencies_rate_success' => 'Taux interdevises supprimé',
    // Partner
    'find_all_partners_success' => 'Partenaires trouvés',
    'find_partner_success' => 'Partenaire trouvé',
    'find_partner_404' => 'Partenaire non trouvé',
    'create_partner_success' => 'Partenaire créé',
    'update_partner_success' => 'Partenaire modifié',
    'delete_partner_success' => 'Partenaire supprimé',
    'how_long_partnership' => 'Combien de temps durera ce partenariat ?',
    'partnership_terminated' => 'Partenariat terminé',
    'partnership_still_active' => 'Le partenariat est toujours actif. Jours restants : :remainingDays',
    // PromoCode
    'find_all_promo_codes_success' => 'Code promos trouvés',
    'find_promo_code_success' => 'Code promo trouvé',
    'find_promo_code_404' => 'Code promo non trouvé',
    'create_promo_code_success' => 'Code promo créé',
    'update_promo_code_success' => 'Code promo modifié',
    'delete_promo_code_success' => 'Code promo supprimé',
    // Work
    'find_all_works_success' => 'Œuvres trouvées',
    'find_work_success' => 'Œuvre trouvée',
    'find_work_404' => 'Œuvre non trouvée',
    'create_work_success' => 'Œuvre créée',
    'create_work_file_500' => 'Le fichier n\'a pas pu être créé',
    'create_image64_500' => 'L\'uploade de l\'image Base64 a échoué',
    'update_work_success' => 'Œuvre modifiée',
    'delete_work_success' => 'Œuvre supprimée',
    // Like
    'find_all_likes_success' => 'J\'aimes trouvés',
    'find_like_success' => 'J\'aime trouvé',
    'find_like_404' => 'J\'aime non trouvé',
    'create_like_success' => 'J\'aime créé',
    'update_like_success' => 'J\'aime modifié',
    'delete_like_success' => 'J\'aime supprimé',
    // File
    'find_all_files_success' => 'Fichiers trouvés',
    'find_file_success' => 'Fichier trouvé',
    'find_file_404' => 'Fichier non trouvé',
    'create_file_success' => 'Fichier créé',
    'update_file_success' => 'Fichier modifié',
    'delete_file_success' => 'Fichier supprimé',
    // Subscription
    'find_all_subscriptions_success' => 'Abonnements trouvés',
    'find_subscription_success' => 'Abonnement trouvé',
    'find_subscription_404' => 'Abonnement non trouvé',
    'create_subscription_success' => 'Abonnement créé',
    'update_subscription_success' => 'Abonnement modifié',
    'delete_subscription_success' => 'Abonnement supprimé',
    'invalidate_subscription_failed' => 'Abonnement toujours valide',
    // Cart
    'find_all_carts_success' => 'Paniers trouvés',
    'find_cart_success' => 'Panier trouvé',
    'find_cart_404' => 'Panier non trouvé',
    'create_cart_success' => 'Panier créé',
    'update_cart_success' => 'Panier modifié',
    'delete_cart_success' => 'Panier supprimé',
    // Product
    'find_all_products_success' => 'Produits trouvé',
    'find_product_success' => 'Produit trouvé',
    'find_product_404' => 'Produit non trouvé',
    'create_product_success' => 'Produit créé',
    'update_product_success' => 'Produit modifié',
    'delete_product_success' => 'Produit supprimé',
    'insufficient_stock' => 'Stock insuffisant pour le produit « :product_name » (disponible : :quantity).',
    'min_max_price_error' => 'Le prix minimum ne peut pas être supérieur au prix maximum.',
    // Role
    'find_all_roles_success' => 'Rôles trouvés',
    'find_role_success' => 'Rôle trouvé',
    'find_role_404' => 'Rôle non trouvé',
    'create_role_success' => 'Rôle créé',
    'update_role_success' => 'Rôle modifié',
    'delete_role_success' => 'Rôle supprimé',
    // User
    'find_all_users_success' => 'Utilisateurs trouvés',
    'find_user_success' => 'Utilisateur trouvé',
    'find_api_token_success' => 'Jeton d\'API trouvé',
    'find_user_404' => 'Utilisateur non trouvé',
    'find_all_members_success' => 'Membres trouvés',
    'find_member_success' => 'Membre trouvé',
    'find_member_404' => 'Membre non trouvé',
    'find_investor_404' => 'Investisseur non trouvé',
    'find_addressee_404' => 'Destinataire non trouvé',
    'find_concerned_404' => 'Concerné non trouvé',
    'find_visitor_404' => 'Visiteur non trouvé',
    'create_user_success' => 'Utilisateur créé',
    'create_investor_success' => 'Vous êtes maintenant un investisseur',
    'login_user_success' => 'Vous êtes connecté(e)',
    'blocked_user' => 'Ce compte est encore bloqué',
    'create_user_SMS_failed' => 'Il y a un problème avec le service des SMS',
    'update_user_success' => 'Utilisateur modifié',
    'update_password_success' => 'Mot de passe modifié',
    'confirm_password_error' => 'Veuillez confirmer votre mot de passe',
    'confirm_new_password' => 'Veuillez confirmer le nouveau mot de passe',
    'delete_user_success' => 'Utilisateur supprimé',
    // Organization
    'find_all_organizations_success' => 'Organisations trouvées',
    'find_organization_success' => 'Organisation trouvée',
    'find_organization_404' => 'Organisation non trouvée',
    'create_organization_success' => 'Organisation créée',
    'update_organization_success' => 'Organisation modifiée',
    'delete_organization_success' => 'Organisation supprimée',
    // CourseYear
    'find_all_course_years_success' => 'Années d\'étude trouvées',
    'find_course_year_success' => 'Année d\'étude trouvée',
    'find_course_year_404' => 'Année d\'étude non trouvée',
    'create_course_year_success' => 'Année d\'étude créée',
    'update_course_year_success' => 'Année d\'étude modifiée',
    'delete_course_year_success' => 'Année d\'étude supprimée',
    // Program
    'find_all_programs_success' => 'Programmes trouvés',
    'find_program_success' => 'Programme trouvé',
    'find_program_404' => 'Programme non trouvé',
    'create_program_success' => 'Programme créé',
    'update_program_success' => 'Programme modifié',
    'delete_program_success' => 'Programme supprimé',
    // Circle
    'find_all_circles_success' => 'Cercles de discussion trouvés',
    'find_circle_success' => 'Cercle de discussion trouvé',
    'find_circle_404' => 'Cercle de discussion non trouvé',
    'create_circle_success' => 'Cercle de discussion créé',
    'update_circle_success' => 'Cercle de discussion modifié',
    'delete_circle_success' => 'Cercle de discussion supprimé',
    // Event
    'find_all_events_success' => 'Evénements trouvés',
    'find_event_success' => 'Evénement trouvé',
    'find_event_404' => 'Evénement non trouvé',
    'create_event_success' => 'Evénement créé',
    'update_event_success' => 'Evénement modifié',
    'delete_event_success' => 'Evénement supprimé',
    // PasswordReset
    'find_all_password_resets_success' => 'Réinitialisations des mots de passe trouvées',
    'find_password_reset_success' => 'Réinitialisation de mot de passe trouvée',
    'find_password_reset_404' => 'Réinitialisation de mot de passe non trouvée',
    'create_password_reset_success' => 'Réinitialisation de mot de passe créée',
    'update_password_reset_success' => 'Réinitialisation de mot de passe modifiée',
    'delete_password_reset_success' => 'Réinitialisation de mot de passe supprimée',
    'verified_token' => 'Code OTP vérifié',
    'unverified_token' => 'Le code OTP n\'est pas encore vérifié',
    'unverified_token_email' => 'Votre adresse e-mail n’est pas encore vérifiée',
    'unverified_token_phone' => 'Votre n° de téléphone n’est pas encore vérifié',
    'bad_token' => 'Le code OTP ne correspond pas',
    'token_label' => 'Votre code OTP :',
    // PersonalAccessToken
    'find_all_personal_access_tokens_success' => 'Jetons personnels trouvés',
    'find_personal_access_token_success' => 'Jeton personnel trouvé',
    'find_personal_access_token_404' => 'Jeton personnel non trouvé',
    'create_personal_access_token_success' => 'Jeton personnel créé',
    'update_personal_access_token_success' => 'Jeton personnel modifié',
    'delete_personal_access_token_success' => 'Jeton personnel supprimé',
    // Message
    'find_all_messages_success' => 'Messages trouvés',
    'find_message_success' => 'Message trouvé',
    'find_message_404' => 'Message non trouvé',
    'find_sender_404' => 'Expéditeur non trouvé',
    'create_message_success' => 'Message créé',
    'update_message_success' => 'Message modifié',
    'delete_message_success' => 'Message supprimé',
    // Notification
    'find_all_notifications_success' => 'Notifications trouvées',
    'find_notification_success' => 'Notification trouvée',
    'find_notification_404' => 'Notification non trouvée',
    'create_notification_success' => 'Notification créée',
    'update_notification_success' => 'Notification modifiée',
    'delete_notification_success' => 'Notification supprimée',
    // ToxicContent
    'find_all_toxic_contents_success' => 'Contenus toxiques trouvés',
    'find_toxic_content_success' => 'Contenu toxique trouvé',
    'find_toxic_content_404' => 'Contenu toxique non trouvé',
    'create_toxic_content_success' => 'Contenu toxique créé',
    'update_toxic_content_success' => 'Contenu toxique modifié',
    'delete_toxic_content_success' => 'Contenu toxique supprimé',
    // Session
    'find_all_sessions_success' => 'Sessions trouvées',
    'find_session_success' => 'Session trouvée',
    'find_session_404' => 'Session non trouvée',
    'create_session_success' => 'Session créée',
    'update_session_success' => 'Session modifiée',
    'delete_session_success' => 'Session supprimée',
    // Payment
    'find_all_payments_success' => 'Paiements trouvés',
    'find_payment_success' => 'Paiement trouvé',
    'find_payment_404' => 'Paiement non trouvé',
    'processing_succeed' => 'Votre transaction a réussie.',
    'error_while_processing' => 'Une erreur lors du traitement de votre requête',
    'process_failed' => 'Impossible de traiter la demande, veuillez réessayer',
    'process_canceled' => 'Vous avez annulé votre transaction',
    'create_payment_success' => 'Paiement créé',
    'update_payment_success' => 'Paiement modifié',
    'delete_payment_success' => 'Paiement supprimé',

    // ===== PUBLIC NOTIFICATIONS
    // Partnership
    'one_partner' => '<strong><a href="/:from_username">:from_user_names</a></strong> est maintenant votre partenaire.',
    'two_partners' => '<strong><a href="/:from_username">:from_user_names</a></strong> et une autre personne sont maintenant vos partenaires.',
    'many_partners' => '<strong><a href="/:from_username">:from_user_names</a></strong> and :requests_count autres sont maintenant vos partenaires.',
    // Sponsoring
    'one_sponsoring_act' => '<strong><a href="/:from_username">:from_user_names</a></strong> vient de vous sponsoriser.',
    'two_sponsoring_acts' => '<strong><a href="/:from_username">:from_user_names</a></strong> et une autre personne viennent de vous sponsoriser.',
    'many_sponsoring_acts' => '<strong><a href="/:from_username">:from_user_names</a></strong> and :requests_count autres viennent de vous sponsoriser.',
    // Consulting
    'one_consulting_act' => '<strong><a href="/:from_username">:from_user_names</a></strong> vient de consulter votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    'two_consulting_acts' => '<strong><a href="/:from_username">:from_user_names</a></strong> et une autre personne viennent de consulter votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    'many_consulting_acts' => '<strong><a href="/:from_username">:from_user_names</a></strong> and :requests_count autres viennent de consulter votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    // Subscriptions
    'one_subscription' => '<strong><a href="/:from_username">:from_user_names</a></strong> a souscrit à votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    'two_subscriptions' => '<strong><a href="/:from_username">:from_user_names</a></strong> et une autre persone ont souscrit à votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    'many_subscriptions' => '<strong><a href="/:from_username">:from_user_names</a></strong> et :requests_count autres ont souscrit à votre <strong><a href="/:to_username/works/:work_id">:work_type</a></strong>.',
    // Payment
    'payment_done' => 'Vous avez effectué un paiement avec le code <strong>:code</strong>. Veuillez cliquer ici pour voir les détails du paiement.',
    // Miscellaneous
    'welcome' => 'Bienvenue <strong><a href="/users/:to_user_id">:to_user_names</a></strong>. Cliquez ici pour lire nos conditions d\'utilisation.',
    'welcome_back' => 'Bon retour <strong><a href="/users/:to_user_id">:to_user_names</a></strong>. Cliquez ici pour voir les nouveautés de la plateforme.',
];
