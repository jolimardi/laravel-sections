<?php

namespace JoliMardi\MySections\Enums;

enum SectionsButtonIcons: string {

	case None = '';
	case ChevronRight = 'coolicon-chevron-right-md';
	case ArrowRight = 'coolicon-arrow-right-md';
	case ExternalLink = 'coolicon-external-link';


	public function label(): string {
		return match ($this) {
			self::None => 'Aucune icône',
			self::ChevronRight => 'Chevron Right',
			self::ArrowRight => 'Arrow Right',
			self::ExternalLink => 'External Link',
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
