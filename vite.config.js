import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';
// Function to get all JavaScript files in the specified directory
function getTsFiles(dir) {
    let tsFiles = [];

    // Read all files and directories in the current directory
    const items = fs.readdirSync(dir);

    items.forEach(item => {
        const fullPath = path.join(dir, item);

        // Check if the item is a directory
        if (fs.statSync(fullPath).isDirectory()) {
            // Recursively search the directory
            tsFiles = tsFiles.concat(getTsFiles(fullPath));
        } else if (item.endsWith('.ts')) {
            // If it's a .ts file, add it to the list
            tsFiles.push(fullPath);
        }
    });

    return tsFiles;
}


const tsFiles = getTsFiles('resources/ts');
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/ts/app.ts', ...tsFiles],
            refresh: true,
        }),
    ], build: {
        outDir: 'public/build',
    },
});
