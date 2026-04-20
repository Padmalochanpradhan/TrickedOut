<?php
// Directory where file chunks will be stored temporarily
$uploadDir = 'uploads/';
$filename = $_POST['filename']; // Original filename
$currentChunk = $_POST['currentChunk']; // Current chunk index
$totalChunks = $_POST['totalChunks']; // Total number of chunks

// Make sure the upload directory exists sdffsdf
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Temporary filename for each chunk
$tempFile = $uploadDir . $filename . '.part' . $currentChunk;

// Move the uploaded chunk to the temporary directory
if (isset($_FILES['chunk']) && move_uploaded_file($_FILES['chunk']['tmp_name'], $tempFile)) {
    // Check if this is the last chunk
    if ($currentChunk + 1 == $totalChunks) {
        // Merge all chunks into the final file
        $finalFile = $uploadDir . $filename;
        $out = fopen($finalFile, 'wb');
        
        // Append all chunks to the final file
        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkFile = $uploadDir . $filename . '.part' . $i;
            $in = fopen($chunkFile, 'rb');
            stream_copy_to_stream($in, $out);
            fclose($in);
            unlink($chunkFile); // Remove the chunk after merging
        }
        fclose($out);

        // Return success response
        echo json_encode(['success' => true, 'message' => 'Upload complete.']);
    } else {
        // Return success response for chunk upload
        echo json_encode(['success' => true, 'message' => 'Chunk uploaded.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to upload chunk.']);
}
?>
