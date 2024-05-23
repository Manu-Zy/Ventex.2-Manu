const makeChangesPreviewScreen = document.querySelector('.makeChangesPreviewScreen');
const headerColorInput = document.getElementById('headerColor');
const categoriesColorInput = document.getElementById('categoriesColor');
const headerPreview = document.querySelector('.headerPreview');
const categoryButtonPreviews = document.querySelectorAll('.categoryButtonPreview');
const previewCatalog = document.getElementById('previewCatalog');
const catalogStyles = document.querySelectorAll('input[name="catalogStyle"]');
const previewProductBox = document.getElementById('previewProductBox');
const productBoxPreviewStyles = document.getElementsByName('productBoxPreviewStyle');
const editCatalogModalContainer = document.querySelector('.editCatalogModalContainer');
const editCatalogOverlay = document.querySelector('.editCatalogOverlay');
const catalogo = document.querySelector('.catalogo');
const cancelButton = document.querySelector('.cancelButton');

const closeModal = () =>{
    editCatalogModalContainer.classList.add('hidden');
    editCatalogOverlay.classList.add('hidden');
}

catalogo.addEventListener('click', (e)=>{
    console.log('pto');
    e.preventDefault();
    editCatalogModalContainer.classList.remove('hidden');
    editCatalogOverlay.classList.remove('hidden');
});
editCatalogOverlay.addEventListener('click', closeModal);
cancelButton.addEventListener('click', closeModal);

const makeChanges = () => {
    const headerColor = headerColorInput ? headerColorInput.value : null;
    const categoriesColor = categoriesColorInput ? categoriesColorInput.value : null;

    if (headerPreview && headerColor) {
        headerPreview.style.backgroundColor = headerColor;
    } else {
        console.error('headerPreview or headerColor is undefined');
    }

    if (categoryButtonPreviews.length > 0 && categoriesColor) {
        categoryButtonPreviews.forEach(button => {
            button.style.backgroundColor = categoriesColor;
        });
    } else {
        console.error('categoryButtonPreviews or categoriesColor is undefined');
    }

    catalogStyles.forEach((style, index) => {
        if (style.checked) {
            previewCatalog.href = `../Styles/Preview-catalogo-${index + 1}.css`;
        }
    });

    productBoxPreviewStyles.forEach((style, index) => {
        if (style.checked) {
            previewProductBox.href = `../Styles/preview-product-box-${index + 1}.css`;
        }
    });
}

// Listener para aplicar los cambios cuando se haga clic en el botón
if (makeChangesPreviewScreen) {
    makeChangesPreviewScreen.addEventListener('click', makeChanges);
} else {
    console.error('makeChangesPreviewScreen is undefined');
}

// Listener para aplicar los cambios automáticamente cuando se cambia el color del header
if (headerColorInput) {
    headerColorInput.addEventListener('input', makeChanges);
} else {
    console.error('headerColorInput is undefined');
}

// Listener para aplicar los cambios automáticamente cuando se cambia el color de las categorías
if (categoriesColorInput) {
    categoriesColorInput.addEventListener('input', makeChanges);
} else {
    console.error('categoriesColorInput is undefined');
}

// Listener para aplicar los cambios automáticamente cuando se selecciona un nuevo estilo de catálogo
catalogStyles.forEach(style => {
    style.addEventListener('change', makeChanges);
});

// Listener para aplicar los cambios automáticamente cuando se selecciona un nuevo estilo de caja de producto
productBoxPreviewStyles.forEach(style => {
    style.addEventListener('change', makeChanges);
});





