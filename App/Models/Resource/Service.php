<?php

namespace App\Models\Resource;

class Service
{
    public function parseItem($item)
    {
        $data = [];
        $keys = array_keys($item->getList());
        foreach ($keys as $key) {
            $keySplit = explode('_', $key);

            foreach ($keySplit as &$element) {
                $element = ucfirst($element);
            }

            $key = implode('', $keySplit);
            $data[$key] = $item->{'get' . $key}();
        }

        return $data;
    }

    public function getDate(): string
    {
        $time = new \DateTime();
        return date('d_m_o__H_i');
    }
}