<?php

namespace Velodome\Velodome\Traits;
use Illuminate\Support\Facades\Http;

trait OpenAITrait
{
    public function completions($base64File)
    {
        $response = Http::withHeaders([
            'Authorization' => getenv('OPEN_AI_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post(getenv('OPEN_AI_URL'), [
            'model' => 'gpt-4-vision-preview',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            "type" => "text",
                            "text" => getenv('OPEN_AI_PROMPT'),
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => 'data:image/png;base64,'.$base64File
                            ]
                        ]
                        
                    ]
                ]
            ],
            "max_tokens" => 300
        ]);
        
        if ($response->successful()) {
            $responseData = json_decode($response->getBody()->getContents(), true);
            $content = $this->extractContent($responseData['choices'][0]['message']['content']);
            return $content;
        } else {
            $errorMessage = $response->body();
            return $errorMessage;
        }
    }

    private function extractContent($content) {
        $pattern = '/\b\w+\s*:\s*\w+\b/';
        preg_match_all($pattern, $content, $matches);

        $extractedStrings = implode(', ', $matches[0]);
        $optimizedString = str_replace([' ', ','], ['', ', '], $extractedStrings);
        
        return $optimizedString;
    }    
}
