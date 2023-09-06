#!/usr/bin/env node

const fs = require('fs');
const PNG = require('pngjs').PNG;
const pixelmatch = require('pixelmatch');

function getMatchingPercentage(imagePath1, imagePath2)
{
    // Read the images
    // @todo support jpg
    const img1 = PNG.sync.read(fs.readFileSync(imagePath1));
    const img2 = PNG.sync.read(fs.readFileSync(imagePath2));

    // Create an empty diff image
    const { width, height } = img1;
    const diff = new PNG({ width, height });

    // Compare the images and write the diff
    const numDiffPixels = pixelmatch(img1.data, img2.data, diff.data, width, height, {
        threshold: 0.1, // Adjust the threshold as needed
    });

    // Calculate the percentage of matching pixels
    const totalPixels = width * height;

    $percentage = ((totalPixels - numDiffPixels) / totalPixels) * 100;

    process.stdout.write(JSON.stringify($percentage));

    return $percentage;
}

function ensureIsSupportedFormat(imagePath)
{
    const isPNG = imagePath.endsWith('.png');
    const isJPEG = imagePath.endsWith('.jpeg') || imagePath.endsWith('.jpg');

    if (!isPNG && !isJPEG) {
        throw new Error('Unsupported image format. Only PNG and JPEG are supported.');
    }
}

try {
    const args = JSON.parse(process.argv.slice(2));

    const matchingPercentage = getMatchingPercentage(args[0], args[1]);
} catch (error) {
    console.error(error);
    process.exit(1);
}
