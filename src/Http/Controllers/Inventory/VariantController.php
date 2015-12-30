<?php

namespace Stevebauman\Maintenance\Http\Controllers\Inventory;

use Stevebauman\Maintenance\Http\Controllers\Controller as BaseController;
use Stevebauman\Maintenance\Http\Requests\Inventory\VariantRequest;
use Stevebauman\Maintenance\Repositories\Inventory\Repository;

class VariantController extends BaseController
{
    /**
     * @var Repository
     */
    protected $inventory;

    /**
     * Constructor.
     *
     * @param Repository $inventory
     */
    public function __construct(Repository $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Displays the form for creating a variant
     * of the specified inventory.
     *
     * @param int|string $inventoryId
     *
     * @return \Illuminate\View\View
     */
    public function create($inventoryId)
    {
        $item = $this->inventory->find($inventoryId);

        return view('maintenance::inventory.variants.create', compact('item'));
    }

    /**
     * Processes creating a variant of the specified
     * inventory item.
     *
     * @param VariantRequest $request
     * @param int|string     $inventoryId
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(VariantRequest $request, $inventoryId)
    {
        $variant = $this->inventory->createVariant($request, $inventoryId);

        if ($variant) {
            $message = sprintf('Successfully created item variant: %s', link_to_route('maintenance.inventory.show', 'Show', [$variant->id]));

            return redirect()->route('maintenance.inventory.show', [$inventoryId, '#tab-variants'])->withSuccess($message);
        } else {
            $message = 'There was an error creating a variant of this item. Please try again.';

            return redirect()->route('maintenance.inventory.show', [$inventoryId])->withErrors($message);
        }
    }
}
