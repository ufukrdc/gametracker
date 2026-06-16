<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RawgService
{
    private string $baseUrl = 'https://api.rawg.io/api';

    public ?string $lastError = null;

    private function key(): ?string
    {
        $key = config('services.rawg.key');

        return $key ? trim($key) : null;
    }

    public function search(string $query, int $pageSize = 12): array
    {
        if (! $this->key()) {
            $this->lastError = 'RAWG_API_KEY okunamadi (config/services.php veya .env).';

            return [];
        }

        try {
            $response = Http::timeout(15)->get($this->baseUrl . '/games', [
                'key'       => $this->key(),
                'search'    => $query,
                'page_size' => $pageSize,
            ]);
        } catch (\Throwable $e) {
            $this->lastError = 'Baglanti hatasi: ' . $e->getMessage();

            return [];
        }

        if (! $response->successful()) {
            $this->lastError = 'RAWG kodu ' . $response->status() . ': ' . $response->body();

            return [];
        }

        return $response->json('results', []);
    }

    public function find(int $rawgId): ?array
    {
        $response = Http::timeout(15)->get($this->baseUrl . '/games/' . $rawgId, [
            'key' => $this->key(),
        ]);

        return $response->successful() ? $response->json() : null;
    }
}
