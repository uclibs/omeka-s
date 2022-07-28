const GRID_CLASS = '.rdt-masonry-grid';

function onLayoutComplete(e) {
    console.log("masonry: layout complete");
}

function setupMasonry() {
    // crams items into a layout
    const masonryOptions = {
        columnWidth: 200,
        gutter: 10,
        itemSelector: '.rdt-grid-item'
    };

    const masonry = new Masonry(GRID_CLASS, masonryOptions);
    masonry.on('layoutComplete', onLayoutComplete);

    masonry.layout();
}

function onReady(e) {
    const gridElement = document.querySelector(GRID_CLASS);
    if (gridElement !== null) 
        setupMasonry();
}

document.addEventListener('DOMContentLoaded', onReady);
