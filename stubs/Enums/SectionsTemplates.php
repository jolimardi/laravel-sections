<?php

namespace App\Enums;

enum SectionsTemplates: string {

	case TextWithImage = 'text-with-image';
	case BannerText = 'banner-text';
	case Text = 'text';
	case TextWithVideo = 'text-with-video';
	case HorizontalCard = 'horizontal-card';


	public function label(): string {
		return match ($this) {
			self::TextWithImage => 'Texte + image',
			self::BannerText => 'Bannière + Texte',
			self::Text => 'Texte seul',
			self::TextWithVideo => 'Texte + vidéo',
			self::HorizontalCard => 'Card horizontale (pour liste)',
		};
	}


	public static function array(): array {
		$result = [];
		foreach (self::cases() as $case) {
			$result[$case->value] = $case->label();
		}
		return $result;
	}


	public static function getLabel(string $value): ?string {
		return self::tryFrom($value)?->label();
	}
}
