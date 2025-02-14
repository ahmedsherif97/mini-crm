<?php

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Vite as ViteFacade;

if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        $module = app()->basePath('/Modules/' . $name);
        return str_replace('//', '/', $module . ($path ? DIRECTORY_SEPARATOR . $path : $path));

        // $module = app('modules')->find($name);
        // return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

function per_page($perPage = 15)
{
    if (request('per_page') == 'all') {
        return 999;
    }

    return request('per_page') ? (int) request('per_page') : $perPage;
}
if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string  $path
     * @return string
     */
    function public_path($path = '')
    {
        return app()->make('path.public') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (!function_exists('module_vite')) {
    /**
     * support for vite
     */
    function module_vite($module, $asset): Vite
    {
        return ViteFacade::useHotFile(storage_path('vite.hot'))->useBuildDirectory($module)->withEntryPoints([$asset]);
    }
}

if (!function_exists('getArrayKeys')) {
    function getArrayKeys($arr, $except = null)
    {
        $arr = array_keys($arr);
        if ($except !== null) $arr = Illuminate\Support\Arr::except($arr, $except);
        return $arr;
    }
}

if (!function_exists('viewToDatatable')) {
    function viewToDatatable($html, $result, array $extra = [])
    {
        // Initialize an empty array to store table data
        $data = [];

        if ($html != '') {

            // Load HTML string into a DOMDocument
            $doc = new DOMDocument();
            $doc->loadHTML('<?xml encoding="UTF-8">' . $html);

            // Iterate through each table row
            foreach ($doc->getElementsByTagName('tr') as $row) {
                // Initialize an empty array to store cell data for each row
                $rowData = [];

                // Iterate through each table cell in the current row
                foreach ($row->getElementsByTagName('td') as $cell) {
                    // Add cell content to the row data array
                    $columnName = $cell->getAttribute('data-column');
                    $rowData[$columnName] = $doc->saveHTML($cell);
                }

                // Add row data to the table data array
                $data[] = (object) $rowData;
            }
        }

        return [
            'data'              => $data,
            'draw'              => request('draw', 0) + 1,
            'currentPage'       => $result->currentPage(),
            'last_page'         => $result->lastPage(),
            //'draw'              => $result->firstItem(),
            'recordsPerPage'    => $result->perPage(),
            "recordsTotal"      => $result->lastItem(),
            "recordsFiltered"   => $result->total(),
            ...$extra
        ];
    }
}
