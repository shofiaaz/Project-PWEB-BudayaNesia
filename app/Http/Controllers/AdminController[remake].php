<?php

// Add this to your AdminController or wherever you handle content approval

use App\Events\ContentApproved;

/**
 * Approve content and trigger badge update
 */
// public function approveContent($id)
// {
//     $content = Konten::findOrFail($id);

//     // Update content status to approved
//     $content->update(['status' => 'approved']);

//     // Fire event to update user badge
//     event(new ContentApproved($content));

//     // Show success message
//     Alert::success('Success', 'Konten berhasil disetujui dan badge pengguna telah diperbarui!');

//     return redirect()->back();
// }

/**
 * Reject content
 */
// public function rejectContent($id)
// {
//     $content = Konten::findOrFail($id);

//     // Update content status to rejected
//     $content->update(['status' => 'rejected']);

//     Alert::warning('Info', 'Konten telah ditolak!');

//     return redirect()->back();
// }

/**
 * Bulk approve contents
 */
// public function bulkApprove(Request $request)
// {
//     $contentIds = $request->input('content_ids', []);

//     if (empty($contentIds)) {
//         Alert::error('Error', 'Pilih konten yang akan disetujui!');
//         return redirect()->back();
//     }

//     $contents = Konten::whereIn('id', $contentIds)->get();

//     foreach ($contents as $content) {
//         $content->update(['status' => 'approved']);
//         event(new ContentApproved($content));
//     }

//     Alert::success('Success', count($contents) . ' konten berhasil disetujui!');

//     return redirect()->back();
// }
