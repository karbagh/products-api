<?php

namespace App\Traits\Translations;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasTranslation
{
    public function translationsColumn(string $locale, string $column): ?string
    {
        return $this->translations->where('locale', $locale)->first()?->$column;
    }

    public function translations(): HasMany
    {
        return $this->hasMany($this->getTranslationRelation());
    }

    public function translation(): HasOne
    {
        return $this->hasOne($this->getTranslationRelation())->where('locale', app()->getLocale());
    }

    public function getAttributeValue($column)
    {
        if (in_array($column, $this->translatable)) {
            return $this->translation()->first()?->$column;
        }

        return parent::getAttributeValue($column);
    }

    public function getNameHyAttribute(): ?string
    {
        return $this->translationsColumn('hy', 'name');
    }

    public function getDescriptionHyAttribute(): ?string
    {
        return $this->translationsColumn('hy', 'description');
    }

    public function getNameRuAttribute(): ?string
    {
        return $this->translationsColumn('ru', 'name');
    }

    public function getDescriptionRuAttribute(): ?string
    {
        return $this->translationsColumn('ru', 'description');
    }

    public function getNameEnAttribute(): ?string
    {
        return $this->translationsColumn('en', 'name');
    }

    public function getDescriptionEnAttribute(): ?string
    {
        return $this->translationsColumn('en', 'description');
    }

    public function getTitleHyAttribute(): ?string
    {
        return $this->translationsColumn('hy', 'title');
    }

    public function getContentHyAttribute(): ?string
    {
        return $this->translationsColumn('hy', 'content');
    }

    public function getTitleRuAttribute(): ?string
    {
        return $this->translationsColumn('ru', 'title');
    }

    public function getContentRuAttribute(): ?string
    {
        return $this->translationsColumn('ru', 'content');
    }

    public function getTitleEnAttribute(): ?string
    {
        return $this->translationsColumn('en', 'title');
    }

    public function getContentEnAttribute(): ?string
    {
        return $this->translationsColumn('en', 'content');
    }
}
