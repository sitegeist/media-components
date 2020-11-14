```
class ImageSource
{
	Image $image;
	SourceSet $srcset;
	CropArea Crop;
	string $format;
}

class CropArea
{
	createFromAspectRatio()
	createFromHeightAndWidth()
	createFromCoordinates()
}

AspectRatio (technisch) vs. CropVariant (semantisch)

class SourceSet
{
	array $items;
}

FormatViewHelper
CropViewHelper
ScaleViewHelper
SrcsetViewHelper
```

```
<mvh:tag tagName="img"
	src="{fallbackImage.publicUrl}"
	srcset="{croppedImage -> mvh:image.srcset(srcset: srcset, base: fallbackImage)}"
	height="{fallbackImage.height}"
	width="{fallbackImage.width}"
	alt="{f:if(condition: alt, then: alt, else: fallbackImage.alternative)}"
	title="{f:if(condition: title, then: title, else: fallbackImage.title)}"
	loading="{f:if(condition: lazyload, then: 'lazy')}"
	sizes="{sizes}"
	class="{class}"
/>
```
