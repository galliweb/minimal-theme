import { defineConfig } from 'vite';
import { resolve } from 'path';

const MAIN_FILE = resolve('src/scripts/main.js')
const ADMIN_FILE = resolve('src/styles/admin.scss')

const BUILD_DIR = resolve(__dirname, 'dist');

export default defineConfig({
  build: {
    assetsDir: '',
    manifest: true,
    emptyOutDir: true,
    outDir: BUILD_DIR,
    rollupOptions: {
      input: {
        main: MAIN_FILE,
        admin: ADMIN_FILE
      },
    },
  },
  css: {
    devSourcemap: true,
  }
});