# IIIF Presentation

An [Omeka S](https://omeka.org/s/) module that implements the [IIIF Presentation API](https://iiif.io/api/presentation/3.0/).

### Endpoints

This module adds the following IIIF Presentation endpoints. Append these to your base Omeka URL. For example, if your Omeka installation is at:

`https://example.com/omeka-s`

And you want to get the IIIF manifest (v3) for item ID #1234, append like this:

`https://example.com/omeka-s/iiif-presentation/3/item/1234/manifest`

##### IIIF Presentation v2

These endpoints are available for version 2 of the IIIF Presentation API.

- `/iiif-presentation/2/item/:item-id/manifest`
    Get the IIIF manifest resource for an Omeka item. Outputs JSON-LD.
    - `:item-id`: The Omeka item ID
- `/iiif-presentation/2/item/:item-id`
    View the IIIF manifest resource for an Omeka item. Redirects to the Omeka S IIIF viewer (Mirador).
    - `:item-id`: The Omeka item ID
- `/iiif-presentation/2/item/:item-ids/collection`
    Get the IIIF collection resource for two or more Omeka items. Outputs JSON-LD.
    - `:item-ids`: The Omeka item IDs, delimited by commas
- `/iiif-presentation/2/item/:item-ids`
    View the IIIF collection resource for two or more Omeka items. Redirects to the Omeka IIIF viewer (Mirador).
    - `:item-ids`: The Omeka item IDs, delimited by commas
- `/iiif-presentation/2/item-set/:item-set-id/collection`
    Get the IIIF collection resource for an Omeka item set. Outputs JSON-LD.
    - `:item-set-id`: The Omeka item set ID
- `/iiif-presentation/2/item-set/:item-set-id`
    View the IIIF collection resource for an Omeka item set. Redirects to the Omeka S IIIF viewer (Mirador).
    - `:item-set-id`: The Omeka item set ID
- `/iiif-presentation/2/item-set/:item-set-ids/collection`
    Get the IIIF collection resource for two or more Omeka item sets. Outputs JSON-LD.
    - `:item-set-ids`: The Omeka item set IDs, delimited by commas
- `/iiif-presentation/2/item-set/:item-set-ids`
    View the IIIF collection resource for two or more Omeka item sets. Redirects to the Omeka IIIF viewer (Mirador).
    - `:item-set-ids`: The Omeka item set IDs, delimited by commas

##### IIIF Presentation v3

These endpoints are available for version 3 of the IIIF Presentation API.

- `/iiif-presentation/3/item/:item-id/manifest`
    Get the IIIF manifest resource for an Omeka item. Outputs JSON-LD.
    - `:item-id`: The Omeka item ID
- `/iiif-presentation/3/item/:item-id`
    View the IIIF manifest resource for an Omeka item. Redirects to the Omeka S IIIF viewer (Mirador).
    - `:item-id`: The Omeka item ID
- `/iiif-presentation/3/item/:item-ids/collection`
    Get the IIIF collection resource for two or more Omeka items. Outputs JSON-LD.
    - `:item-ids`: The Omeka item IDs, delimited by commas
- `/iiif-presentation/3/item/:item-ids`
    View the IIIF collection resource for two or more Omeka items. Redirects to the Omeka IIIF viewer (Mirador).
    - `:item-ids`: The Omeka item IDs, delimited by commas
- `/iiif-presentation/3/item-set/:item-set-id/collection`
    Get the IIIF collection resource for an Omeka item set. Outputs JSON-LD.
    - `:item-set-id`: The Omeka item set ID
- `/iiif-presentation/3/item-set/:item-set-id`
    View the IIIF collection resource for an Omeka item set. Redirects to the Omeka S IIIF viewer (Mirador).
    - `:item-set-id`: The Omeka item set ID
- `/iiif-presentation/3/item-set/:item-set-ids/collection`
    Get the IIIF collection resource for two or more Omeka item sets. Outputs JSON-LD.
    - `:item-set-ids`: The Omeka item set IDs, delimited by commas
- `/iiif-presentation/3/item-set/:item-set-ids`
    View the IIIF collection resource for two or more Omeka item sets. Redirects to the Omeka IIIF viewer (Mirador).
    - `:item-set-ids`: The Omeka item set IDs, delimited by commas

### Events

This module triggers these events during the composition of certain IIIF Presentation resources (manifest, canvas, collection, etc.). Use the event's `getTarget()` method to get the current controller.

##### IIIF Presentation v2

These events are available for version 2 of the IIIF Presentation API.

- `iiif_presentation.2.media.canvas`
    Triggered after composing a media canvas array. To modify the canvas, handlers may modify the `canvas` parameter and set it back to the event.
    - `canvas`: The canvas array
    - `canvas_type`: The canvas type service object
    - `media_id`: The media ID
- `iiif_presentation.2.item.manifest`
    Triggered after composing an item manifest array. To modify the manifest, handlers may modify the `manifest` parameter and set it back to the event.
    - `manifest`: The manifest array
    - `item_id`: The item ID
- `iiif_presentation.2.item.collection`
    Triggered after composing an item collection array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_ids`: The item IDs in the collection
- `iiif_presentation.2.item_set.collection`
    Triggered after composing an item set collection array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_set_id`: The item set ID
- `iiif_presentation.2.item_set.collections`
    Triggered after composing an item set collections array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_set_ids`: The item set IDs in the collection

##### IIIF Presentation v3

These events are available for version 3 of the IIIF Presentation API.

- `iiif_presentation.3.media.canvas`
    Triggered after composing a media canvas array. To modify the canvas, handlers may modify the `canvas` parameter and set it back to the event.
    - `canvas`: The canvas array
    - `canvas_type`: The canvas type service object
    - `media_id`: The media ID
- `iiif_presentation.3.item.manifest`
    Triggered after composing an item manifest array. To modify the manifest, handlers may modify the `manifest` parameter and set it back to the event.
    - `manifest`: The manifest array
    - `item_id`: The item ID
- `iiif_presentation.3.item.collection`
    Triggered after composing an item collection array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_ids`: The item IDs in the collection
- `iiif_presentation.3.item_set.collection`
    Triggered after composing an item set collection array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_set_id`: The item set ID
- `iiif_presentation.3.item_set.collections`
    Triggered after composing an item set collections array. To modify the collection, handlers may modify the `collection` parameter and set it back to the event.
    - `collection`: The collection array
    - `item_set_ids`: The item set IDs in the collection

### Copyright

IiifPresentation is Copyright © 2021-present Corporation for Digital Scholarship, Vienna, Virginia, USA http://digitalscholar.org

The Corporation for Digital Scholarship distributes the Omeka source code under the GNU General Public License, version 3 (GPLv3). The full text of this license is given in the license file.

The Omeka name is a registered trademark of the Corporation for Digital Scholarship.

Third-party copyright in this distribution is noted where applicable.

All rights not expressly granted are reserved.
