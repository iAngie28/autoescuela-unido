# 🛠️ Recuperación de cambios perdidos en Git (Rama Gustavo)

Este documento resume el problema enfrentado con la rama `Gustavo` y los pasos realizados para recuperar y subir correctamente el commit `a4c8a11` a GitHub.

---

## 🧩 Problema

Después de realizar un commit importante (`a4c8a11`) en la rama `Gustavo`, al intentar hacer `git push` a `origin/Gustavo`, se rechazó el envío por diferencias en el historial. Además, los cambios del commit no se reflejaban en ramas posteriores, lo que generó confusión sobre su estado.

---

## ✅ Solución paso a paso

### 1. Ver el historial de commits y ramas

```bash
git log --oneline --graph --decorate
```

> Permite visualizar el historial de commits en forma de árbol. Confirmamos que `a4c8a11` existía en la rama `Gustavo` local pero no en `origin/Gustavo`.

---

### 2. Inspeccionar el contenido del commit

```bash
git show a4c8a11
```

> Se revisaron los cambios línea por línea para asegurarse de que el commit incluía los archivos y modificaciones importantes.

---

### 3. Ver resumen de archivos modificados

```bash
git show --stat a4c8a11
```

> Se verificó rápidamente qué archivos fueron modificados y cuántas líneas fueron agregadas/eliminadas.

---

### 4. Crear una nueva rama desde ese commit

```bash
git checkout -b Gustavo a4c8a11
```

> Se creó una nueva rama `Gustavo` desde ese commit para poder subirla a GitHub correctamente.

---

### 5. Subir la rama a GitHub con seguimiento

```bash
git push --set-upstream origin Gustavo
```

> Se subió la rama y se estableció un "tracking branch" para que futuros `push` y `pull` funcionen automáticamente.

---

## 🎉 Resultado

- El commit `a4c8a11` fue recuperado exitosamente.
- Se creó y subió la rama `Gustavo` con ese commit como último cambio.
- El trabajo quedó a salvo y disponible en GitHub.