<?php

namespace App\Enums;

enum SectionsMaxWidths: string {
	case MaxWidth = 'max-width';
	case MaxWidthSmall = 'max-width-small';
	case MaxWidthLarge = 'max-width-large';


	public function label(): string {
		return match ($this) {
			self::MaxWidth => 'Largeur normale (max-width)',
			self::MaxWidthSmall => 'Petite largeur (max-width-small)',
			self::MaxWidthLarge => 'Grande largeur (max-width-large)',
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
