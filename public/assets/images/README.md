# Image Asset Naming Convention

## Folder Structure

```
public/assets/images/
├── banners/          → Hero/banner slider images
│   ├── banner-1.jpg  (1920×1080 recommended)
│   ├── banner-2.jpg
│   ├── banner-3.jpg
│   ├── banner-4.jpg
│   └── banner-5.jpg
│
├── products/         → Product card images
│   ├── product-1.jpg (800×1000 recommended — 4:5 ratio)
│   ├── product-2.jpg
│   └── product-N.jpg
│
├── categories/       → Category section images
│   ├── category-women.jpg
│   ├── category-men.jpg
│   └── category-accessories.jpg
│
├── collections/      → Collection/campaign images
│   ├── collection-summer.jpg
│   ├── collection-winter.jpg
│   └── mega-feature.jpg
│
├── brands/           → Brand logo images
│   └── brand-1.png
│
├── icons/            → Custom SVG/PNG icons
│
├── logos/            → Site logo variants
│   ├── logo.svg
│   ├── logo-dark.svg
│   └── logo-white.svg
│
├── users/            → User avatar images
│   └── avatar-placeholder.jpg
│
└── placeholders/     → Generic placeholder images
    ├── placeholder-product.jpg
    ├── placeholder-banner.jpg
    └── placeholder-avatar.jpg
```

## Usage in Blade

```blade
{{ asset('assets/images/banners/banner-1.jpg') }}
{{ asset('assets/images/products/product-1.jpg') }}
{{ asset('assets/images/categories/category-women.jpg') }}
{{ asset('assets/images/placeholders/placeholder-product.jpg') }}
```

## Recommended Sizes

| Folder       | Width  | Height | Ratio |
|--------------|--------|--------|-------|
| banners      | 1920px | 1080px | 16:9  |
| products     | 800px  | 1000px | 4:5   |
| categories   | 600px  | 750px  | 4:5   |
| collections  | 1200px | 800px  | 3:2   |
| logos        | 200px  | auto   | —     |
| placeholders | varies | varies | —     |
