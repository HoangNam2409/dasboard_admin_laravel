<?php

namespace App\Services\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface LanguageServiceInterface
{
    public function paginate($request);
    public function create($request);
    public function update($request, $id);
    public function destroy(string $id);
    public function updateStatus(array $post = []);
    public function updateStatusAll(array $post = []);
}