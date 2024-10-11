# Media Components

**This extension is still in development and might not ready for production usage.**

This extension provides ready-to-use [Fluid Components](https://github.com/sitegeist/fluid-components) for various media assets:

* Images
    * [Image tag with support for srcset/sizes](./Resources/Private/Components/Image/Image.html)
    * [Picture tag with support for image types and different responsive breakpoints](./Resources/Private/Components/Picture/Picture.html)
* Audio files
    * [HTML5 audio tag](./Resources/Private/Components/Audio/Audio.html)
* Video files
    * [HTML5 video tag with support for subtitles](./Resources/Private/Components/Video/Video.html)

## Usage

We use the public namespace from fluid-components.

### Images
```html
<fc:image src="{width:200, height:100}" />

<fc:image
    src="5"
    width="500"
    height="100"
    maxDimensions="true"
    cropVariant="Default"
    srcset="400w, 800w, 1200w"
    sizes="(min-width: 400px) 400px, (min-width: 800px) 800px, (min-width:1200px) 1200px, 100vw"
    format="jpg"
    alt="Alt text"
    title="Title text"
    lazyload="true"
    preload="true"
/>
```

### Pictures
```html
<fc:picture
    src="{originalImage: {fileUid: 5}, srcset: \'400,800,1200\'}"
    sources="{desktop: {originalImage: {fileUid: 5}, srcset: \'1000, 1200, 1400, 1600, 1800, 2000\'}}"
    width="500"
    height="100"
    maxDimensions="true"
    alt="Alt text"
    title="Title text"
    lazyload="true"
    preload="true"
/>
```

### Video
```html
<fc:video
    sources="{0: 7}"
    tracks="{0: 8}"
    width="800"
    height="600"
    autoplay="false"
    controls="true"
    loop="true"
    muted="false"
    poster="{fileUid: 4}"
    preload="metadata"
    fallbackText="Fallback"
    crossorigin="anonymous"
    playsinline="true"
/>
```

### Audio
```html
<fc:audio
    sources="{0: 1, 1: 2, 3: 2}"
    autoplay="true"
    controls="true"
    loop="true"
    muted="true"
    preload="metadata"
    fallbackText="Fallback"
    crossorigin="anonymous"
/>
```
