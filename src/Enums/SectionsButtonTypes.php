<?php

namespace JoliMardi\MySections\Enums;

enum SectionsButtonTypes: string {
	case Primary = 'btn-primary';
	case Secondary = 'btn-secondary';


	public function label(): string {
		return match ($this) {
			self::Primary => 'Bouton Principal (primary)',
			self::Secondary => 'Bouton Secondaire (secondary)',
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
