<?php

namespace App\Services;

class PromptBuilder
{
    public static function build(array $data)
    {
        $subject = trim($data['subject'] ?? '');
        $style = trim($data['style'] ?? '');
        $composition = trim($data['composition'] ?? '');
        $lighting = trim($data['lighting'] ?? '');
        $colors = trim($data['colors'] ?? '');
        $details = trim($data['details'] ?? '');

        $negative = self::negativePrompt($data);

        $prompt = "
Act as a professional digital illustrator and concept artist.

Create a high quality illustration of: {$subject}.

STYLE
{$style}

COMPOSITION
{$composition}

LIGHTING
{$lighting}

COLOR PALETTE
" . self::colorText($colors) . "

DETAILS
{$details}

QUALITY
high detail illustration,
professional artwork,
clean composition,
visually balanced composition,
sharp focus,
high resolution,
simple background,
subject clearly visible,
modern illustration style
";

        return [
            'prompt' => trim($prompt),
            'negative_prompt' => $negative
        ];
    }

    private static function colorText($colors)
    {
        if ($colors === "soft") {
            return "soft pastel palette, muted tones, gentle harmony, low saturation";
        }

        if ($colors === "vibrant") {
            return "vibrant colors, rich saturation, strong contrast";
        }

        return $colors;
    }

    private static function negativePrompt($data)
    {
        $negatives = [
            "blurry",
            "low quality",
            "distorted",
            "bad anatomy",
            "pixelated",
            "noise",
            "watermark",
            "text artifacts"
        ];

        if (($data['colors'] ?? '') === 'soft') {
            $negatives[] = "neon colors";
            $negatives[] = "vibrant colors";
            $negatives[] = "oversaturated";
        }

        if (($data['colors'] ?? '') === 'vibrant') {
            $negatives[] = "pastel colors";
            $negatives[] = "washed out colors";
        }

        return implode(', ', $negatives);
    }
}