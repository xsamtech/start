<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Storage;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class GoogleDriveService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json'));
        $this->client->addScope(Drive::DRIVE);
        $this->service = new Drive($this->client);
    }

    /**
     * Upload a local file to Google Drive and return its public URL
     *
     * @param string $localPath
     * @param string $filename
     * @param string|null $folderId
     * @return string|null
     */
    public function uploadLocalFile(string $localPath, string $filename, string $mimeType = null, string $folderId = null): ?string
    {
        if (!file_exists($localPath)) {
            return null;
        }

        $fileMetadata = new DriveFile([
            'name' => $filename,
            'parents' => $folderId ? [$folderId] : [],
        ]);

        $mimeType = $mimeType ?: mime_content_type($localPath);
        $content = file_get_contents($localPath);

        $file = $this->service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $mimeType,
            'uploadType' => 'multipart',
            'fields' => 'id',
            'supportsAllDrives' => true, // ✅ important pour les Drives partagés
        ]);

        // 🔒 Lecture seule pour tout le monde (publique)
        $this->service->permissions->create($file->id, new Drive\Permission([
            'type' => 'anyone',
            // 'role' => 'reader', // <== lecture seule
            'role' => 'writer', // modification autorisée
        ]));

        // 🔗 Aperçu (pas téléchargement direct)
        return "https://drive.google.com/file/d/{$file->id}/view";
    }
}
