# Media Components

**This extension is still in development and is clearly not ready for production usage.**

This extension provides ready-to-use [Fluid Components](https://github.com/sitegeist/fluid-components) for various media assets:

* Images
    * [Image tag with support for srcset/sizes](./Resources/Private/Components/Image/Image.html)
    * [Picture tag with support for image types and different responsive breakpoints](./Resources/Private/Components/Picture/Picture.html)
* Audio files
    * [HTML5 audio tag](./Resources/Private/Components/Audio/Audio.html)
* Video files
    * [HTML5 video tag with support for subtitles](./Resources/Private/Components/Video/Video.html)

## Current development

We try to decouple Fluid Components and Media Components while also enhancing the basic data structures in Fluid Components during development of Media Components. This leads to several Pull Requests in Fluid Components, which need to be merged and released before Media Components can be released.

Current Pull Requests:

* [Respect class inheritance during component argument conversion](https://github.com/sitegeist/fluid-components/pull/121)
* [Provide image dimensions in data structures](https://github.com/sitegeist/fluid-components/pull/122)

If you want to participate in the development, feel free to get in contact. You can also create issues, review pull requests or even contribute code.
