<?php

namespace App\Services;

interface AsetService
{
    /**
     * store file
     * @param object $request->file()
     * @param string judul
     */
    public function store($request_file, $judul);

    /**
     * update file
     * @param object $request->file()
     * @param uuid $id
     */
    public function update($request_file, $id);

    /**
     * destroy file
     * @param string id_asset
     */
    public function destroy($id);
}