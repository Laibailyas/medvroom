<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProviderDocumentController extends Controller
{
    /**
     * Stream a provider's uploaded document to an authenticated admin.
     *
     * This deliberately does NOT rely on Storage::url() / the public disk
     * symlink (public/storage -> storage/app/public). On many shared/cPanel
     * hosts, Apache's `Options SymLinksIfOwnerMatch` rejects that symlink
     * with a 403 whenever the symlink's owner differs from the target
     * folder's owner (a very common state after deploys via a different
     * user/process than the one that ran `storage:link`). Reading the file
     * through PHP here sidesteps that entirely — it works immediately for
     * every already-uploaded document, old or new, regardless of symlink
     * state or web-server permissions, since the same PHP process that
     * wrote the file can always read it back.
     *
     * As a side benefit, this also means these documents are no longer
     * sitting on a world-readable public URL — only authenticated admins
     * hitting this route (via the admin auth middleware on this route)
     * can view them.
     */
    public function show(DoctorProfile $doctor, string $type): StreamedResponse|Response
    {
        $column = match ($type) {
            'license'      => 'document_license_path',
            'id'           => 'document_id_path',
            'malpractice'  => 'document_malpractice_path',
            default        => abort(404),
        };

        $path = $doctor->{$column};

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404, 'Document not found.');
        }

        return Storage::disk('public')->response($path);
    }
}
