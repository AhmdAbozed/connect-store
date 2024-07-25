import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';
// Function to get all JavaScript files in the specified directory
function getTsFiles(dir) {
  return fs.readdirSync(dir)
    .filter(file => file.endsWith('.ts'))
    .map(file => path.join(dir, file));
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
