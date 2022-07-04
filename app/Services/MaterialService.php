<?php

namespace App\Services;

use App\Models\Material;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MaterialService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createMaterial(array $data)
    {
        return Material::create([
            'type_id' => $data['type']->id,
            'category_id' => $data['category']->id,
            'name' => $data['materialName'],
            'author' => $data['materialAuthors'],
            'description' => $data['materialDescription'],
        ]);
    }

    /**
     * @param Material $material
     * @param array $data
     * @return bool
     */
    public function editMaterial(Material $material, array $data): bool
    {
        $material->type_id = $data['type']->id;
        $material->category_id = $data['category']->id;
        $material->name = $data['materialName'];
        $material->author = $data['materialAuthors'];
        $material->description = $data['materialDescription'];

        if ($material->save()) {
            return true;
        }

        return false;
    }

    /**
     * @param Material $material
     * @return void
     */
    public function deleteMaterial(Material $material): void
    {
        $material->delete();
    }

    /**
     * @param Material $material
     * @param array $data
     * @return void
     */
    public function addLink(Material $material, array $data): void
    {
        $materialLinks = json_decode($material->data, 1);
        $data['link-uuid'] = Str::uuid();

        if (!$materialLinks) {
            $materialLinks['links'] = [$data];
        } else {
            $materialLinks['links'][] = $data;
        }

        $material->data = json_encode($materialLinks, 1);

        $material->save();
    }

    public function editLink(Material $material, array $data)
    {
        $links = $material->links();
        $materialData = json_decode($material->data,1);


        foreach ($links as $key => $link) {
            if ($link['link-uuid'] != $data['uuid']) {
                continue;
            }

            array_splice($links, $key, 1);
            $link['link-description'] = $data['newLinkDescription'];
            $link['link-utl'] = $data['newLinkUrl'];
            $link['link-uuid'] = $data['uuid'];
            $links[] = $link;
        }
        $materialData['links'] = $links;
        $material->data = json_encode($materialData);

        $material->save();
    }

    /**
     * @param Material $material
     * @param string $uuid
     * @return void
     */
    public function deleteLink(Material $material, string $uuid): void
    {
        $links = $material->links();
        $data = json_decode($material->data,1);

        foreach ($links as $key => $link) {
            if ($link['link-uuid'] != $uuid) {
                continue;
            }
            array_splice($links, $key, 1);
        }
        $data['links'] = $links;
        $material->data = json_encode($data);

        $material->save();
    }
}
