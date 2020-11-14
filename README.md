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
