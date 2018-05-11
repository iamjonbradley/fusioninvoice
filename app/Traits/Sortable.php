<?php

namespace FI\Traits;

trait Sortable
{
    public function scopeSortable($query, $defaultSort = [])
    {
        if (request()->has('s') and request()->has('o') and isset($this->sortable) and is_array($this->sortable) and in_array(request('s'), $this->sortable))
        {
            return $query->orderBy(request('s'), request('o'));
        }
        elseif ($defaultSort)
        {
            foreach ($defaultSort as $col => $sort)
            {
                $query->orderBy($col, $sort);
            }

            return $query;
        }

        return $query;
    }

    public static function link($col, $title = null, $requestMatches = null)
    {
        if ($requestMatches and !request()->is($requestMatches))
        {
            return $title;
        }

        if (is_null($title))
        {
            $title = str_replace('_', ' ', $col);
            $title = ucfirst($title);
        }

        $indicator  = (request('s') == $col ? (request('o') === 'asc' ? '&uarr;' : '&darr;') : null);
        $parameters = array_merge(request()->all(), ['s' => $col, 'o' => (request('o') === 'asc' ? 'desc' : 'asc')]);

        return link_to_route(request()->route()->getName(), "$title $indicator", $parameters);
    }
}