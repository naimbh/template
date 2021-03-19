<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DatatableController extends Controller
{
    public function pendingDocs()
    {
        $query = Pdf::where('link', '!=', 'null')
            ->where('is_signed', 0)
            ->where('is_resolved', 0)
            ->latest();

        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('created_at', '{{Carbon\Carbon::parse($created_at)->format("d/m/y")}}')
            ->addColumn('actions', function ($item) {
                $link = $item->link;
                $data = "$link',this,'$item->client_phone";
                return '<a title="Preview doc?" target="_blank" class="btn btn-secondary btn-sm" href=' . route('sign.pad', $link) . '><i class="fas fa-eye"></i></a> |
                <a title="Edit doc?" target="_blank" class="btn btn-warning btn-sm" href=' . route('docs.edit', $link) . '><i class="fas fa-pencil-alt"></i></a> |
                <span title="Delete doc?" class="btn btn-danger btn-sm" onclick=' . "deleteDoc('$link')" . '><i class="fas fa-archive"></i></span> |
                <span title="Send WhatsApp Msg?"  class="btn btn-success btn-sm" onclick=' . "sendWhatsApp('$data')" . '><i class="fab fa-whatsapp"></i></span> |
                <span title="Copy to clipboard?"  class="btn btn-primary btn-sm copy" data-clipboard-text=' . route('sign.pad', $link) . '><i class="fas fa-copy"></i></span>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function signedDocs()
    {
        $query = Pdf::where('link', '!=', 'null')
            ->where('is_signed', 1)
            ->where('is_resolved', 0)
            ->latest();

        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('created_at', '{{Carbon\Carbon::parse($created_at)->format("d/m/y")}}')
            ->editColumn('link', function ($item) {
                return '<a download class="btn btn-primary btn-sm" href=' . asset("storage/signed/$item->id.pdf") . '><i class="fas fa-download"></i></a> |
                 <a target="_blank" class="btn btn-secondary btn-sm" href=' . route('sign.pad', $item->link) . '><i class="fas fa-eye"></i></a> |
                 <span class="btn btn-warning btn-sm" onclick=' . "resolveDoc('$item->link')" . '>Resolve</span>';
            })
            ->rawColumns(['link'])
            ->toJson();
    }

    public function resolvedDocs()
    {
        $query = Pdf::where('link', '!=', 'null')
            //->where('is_signed', 1)
            ->where('is_resolved', 1)
            ->latest();

        return datatables()->of($query)
            ->addIndexColumn()
            ->editColumn('created_at', '{{Carbon\Carbon::parse($created_at)->format("d/m/y")}}')
            ->editColumn('link', function ($item) {
                return '<a download class="btn btn-primary btn-sm" href=' . asset("storage/signed/$item->id.pdf") . '><i class="fas fa-download"></i></a> |
                 <a target="_blank" class="btn btn-secondary btn-sm" href=' . route('sign.pad', $item->link) . '><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['link'])
            ->toJson();
    }

}
