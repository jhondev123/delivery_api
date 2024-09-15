<?php

namespace App\Http\Filters;

final class SearchProductFilter
{
    private string $searchByName = '';
    private string $searchByDescription = '';
    private string $searchByGroup = '';

    public function setFilters(array $filters)
    {
        if (isset($filters['name'])) {
            $this->setSearchByName($filters['name']);
        }
        
        if (isset($filters['description'])) {
            $this->setSearchByDescription($filters['description']);
        }

        if (isset($filters['group'])) {
            $this->setSearchByGroup($filters['group']);
        }
    }

    public function getSearchByName(): string
    {
        return $this->searchByName;
    }
    public function setSearchByName(string $searchByName): SearchProductFilter
    {
        $this->searchByName = $searchByName;
        return $this;
    }
    public function getSearchByDescription(): string
    {
        return $this->searchByDescription;
    }
    public function setSearchByDescription(string $searchByDescription): SearchProductFilter
    {
        $this->searchByDescription = $searchByDescription;
        return $this;
    }
    public function getSearchByGroup(): string
    {
        return $this->searchByGroup;
    }
    public function setSearchByGroup(string $searchByGroup): SearchProductFilter
    {
        $this->searchByGroup = $searchByGroup;
        return $this;
    }
}
