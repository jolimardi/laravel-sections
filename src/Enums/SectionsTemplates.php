<?php

namespace JoliMardi\MySections\Enums;

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


	public static function getLabel(int $value): ?string {
		return self::tryFrom($value)?->label();
	}
}
