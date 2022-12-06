<?php

namespace App\Services;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselService
{

    // protected $model;
    // public function __construct(Vessel $model)
    // {
    //     $this->model = $model;
    // }

    function list(Request $request) {
        $search = $request->get('search');
        $fields = $request->get('fields', [
            'id',
            'shape',
            'apiVersion',
            'detectionMetadata',
            'collectionMetadata',
            'isCorrelated',
            'imageChipName',
        ]);
        $vc = $request->get('vesselClass');
        $vehicle = $request->get('vehicle');
        $column = [
            'vehicle' => 'collectionMetadata->vehicle',
        ];
        $orderColumn = empty($column[$request->sortBy]) ? 'collectionMetadata->collectionDatetime' : $column[$request->sortBy];
        $orderDirection = $request->descending == 'true' ? 'DESC' : 'ASC';

        $query = Vessel::select($fields)
            ->when($vc, function ($query, $vc) {
                return $query->where('detectionMetadata->vesselClass', $vc);
            })
            ->when($vehicle, function ($query, $vehicle) {
                return $query->where('collectionMetadata->vehicle', $vehicle);
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereRaw('UPPER(collectionMetadata->"$.vehicle") like "%' . strtoupper($search) . '%"')
                        ->orWhereRaw('UPPER(detectionMetadata->"$.vesselClass") like "%' . strtoupper($search) . '%"')
                    ;
                });
            })
            ->orderBy($orderColumn, $orderDirection);

        // $cache_key = 'vessel-list-' . md5(json_encode($request->all()));
        // $cache_time = config('cache.timeout', 60 * 24 * 7);
        // $data = cache()->tags(['vessel'])->remember($cache_key, $cache_time, function () use ($request, $query) {
        $page = $request->get('page');
        $perpage = $request->get('rowsPerPage', 15);
        if (empty($page)) {
            return $query->get();
        }

        return $query->paginate($perpage);
        // });

        // return $data;
    }

}
