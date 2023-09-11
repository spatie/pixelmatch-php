#!/usr/bin/env node

const fs = require('fs');
const PNG = require('pngjs').PNG;
const Pixelmatch = require('Pixelmatch');

try {
    const args = JSON.parse(process.argv.slice(2));

    getMatchingPercentage(args[0], args[1], args[2], args[3]);
} catch (error) {
    console.error(error);
    process.exit(1);
}

function getMatchingPercentage(imagePath1, imagePath2, options = {})
{
    const img1 = PNG.sync.read(fs.readFileSync(imagePath1));
    const img2 = PNG.sync.read(fs.readFileSync(imagePath2));

    // Create an empty diff image
    const { width, height } = img1;
    const diff = new PNG({ width, height });

    const mismatchedPixels = Pixelmatch(
        img1.data,
        img2.data,
        diff.data,
        width,
        height,
        options
    );

    process.stdout.write(JSON.stringify({
        mismatchedPixels,
        width,
        height,
    }))
}
