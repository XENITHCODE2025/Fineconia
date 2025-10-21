// generate-thumbnails.js
import fs from "fs-extra";
import path from "path";
import { createCanvas } from "canvas";
import * as pdfjsLib from "pdfjs-dist/legacy/build/pdf.mjs";

// Rutas base
const pdfDir = "storage/app/public/guias";
const outputDir = "storage/app/public/thumbnails";

// Ajuste necesario para Node (worker de PDF.js)
pdfjsLib.GlobalWorkerOptions.workerSrc = path.resolve(
  "node_modules/pdfjs-dist/build/pdf.worker.js"
);

// 🔧 Solución al error "Invalid factory url"
// Directorio donde pdfjs buscará fuentes estándar (debe terminar con '/')
const fontDir = path.join(process.cwd(), "node_modules/pdfjs-dist/standard_fonts/") + "/";
pdfjsLib.GlobalWorkerOptions.standardFontDataUrl = fontDir;

// Generar miniatura
async function generateThumbnail(pdfPath, outputPath) {
  try {
    const data = new Uint8Array(await fs.readFile(pdfPath));

    const pdf = await pdfjsLib.getDocument({
      data,
      standardFontDataUrl: fontDir, // ✅ Se asegura la ruta correcta
    }).promise;

    const page = await pdf.getPage(1);
    const viewport = page.getViewport({ scale: 0.4 });

    const canvas = createCanvas(viewport.width, viewport.height);
    const context = canvas.getContext("2d");

    await page.render({ canvasContext: context, viewport }).promise;

    const buffer = canvas.toBuffer("image/jpeg", { quality: 0.9 });
    await fs.outputFile(outputPath, buffer);
    console.log(`✅ Miniatura creada: ${outputPath}`);
  } catch (err) {
    console.error(`❌ Error con ${pdfPath}: ${err.message}`);
  }
}

// Recorrer todas las subcarpetas de PDFs
async function processDirectory(dir) {
  const items = await fs.readdir(dir);
  for (const item of items) {
    const itemPath = path.join(dir, item);
    const stats = await fs.stat(itemPath);

    if (stats.isDirectory()) {
      await processDirectory(itemPath);
    } else if (item.endsWith(".pdf")) {
      const relativePath = path.relative(pdfDir, itemPath);
      const outputPath = path.join(
        outputDir,
        relativePath.replace(".pdf", ".jpg")
      );
      await fs.ensureDir(path.dirname(outputPath));
      await generateThumbnail(itemPath, outputPath);
    }
  }
}

(async () => {
  console.log("🖼 Generando miniaturas desde PDFs...");
  await fs.ensureDir(outputDir);
  await processDirectory(pdfDir);
  console.log("🎉 Miniaturas generadas correctamente.");
})();
