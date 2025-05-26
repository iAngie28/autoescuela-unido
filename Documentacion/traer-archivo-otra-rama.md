# 🛠️ Traer un archivo específico de otra rama en Git

Este documento explica cómo traer un único archivo desde otra rama sin hacer merge, y subir ese cambio al repositorio remoto.

---

## ✅ 1. Traer un archivo de otra rama

Supongamos que estás en la rama `main` y quieres traer un archivo desde la rama `gustavo`:

```bash
git checkout gustavo -- ruta/del/archivo.ext
```

📌 **Ejemplo:**
```bash
git checkout gustavo -- app/Models/Bitacora.php
```

---

## ✅ 2. Hacer commit del archivo

Luego de traer el archivo, haz un commit para registrar el cambio:

```bash
git add ruta/del/archivo.ext
git commit -m "Traído archivo desde rama gustavo"
```

---

## ✅ 3. Hacer push de los cambios

Asegúrate de estar en la rama correcta (por ejemplo, `merge`) y haz push:

```bash
git push origin nombre-de-la-rama
```

📌 **Ejemplo:**
```bash
git push origin merge
```

---

## ✅ Resumen rápido

```bash
git checkout otra-rama -- ruta/del/archivo
git add ruta/del/archivo
git commit -m "Traído archivo desde otra rama"
git push origin mi-rama
```

---

## ℹ️ Notas

- Esto **no hace merge** ni afecta otros archivos.
- Puedes repetir el proceso para varios archivos si es necesario.
