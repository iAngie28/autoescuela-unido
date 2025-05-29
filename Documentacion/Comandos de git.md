# Para descargar la versión del git
```git
# Entra al directorio del proyecto
cd ~/proyectos/mi-repositorio

# Descarga los últimos cambios de GitHub
git fetch origin

# Resetea la rama main local para que coincida con GitHub
git reset --hard origin/main

# Opcional: Elimina archivos no rastreados (si es necesario)
git clean -fd

# Verificar el repositorio
git remote -v

```

# Subir
```
git add .
git commit -m "mensaje"
git push
```

# Descargar de una rama

### ✅ 1. Cambiarte a la rama que quieres actualizar (por ejemplo, `main`)

```bash
git checkout main
```

---

### ✅ 2. Traer los últimos cambios del repositorio remoto

```bash
git pull origin main
```

Esto actualiza tu copia local de `main` con los cambios que están en el repositorio remoto.

---

### ✅ 3. (Opcional) Si estabas trabajando en otra rama y quieres actualizarla con lo nuevo de `main`

Primero cámbiate de vuelta a tu rama:

```bash
git checkout tu-rama
```

Y luego haces un **merge** o un **rebase** desde `main`:

#### Opción A: Merge

```bash
git merge main
```

#### Opción B: Rebase (mantiene el historial más limpio)

```bash
git rebase main
```


Saber tu rama
```
git branch

```

# ✅ Paso a paso: Reemplazar una rama por otra

### 🧾 Ejemplo:

- Quiero que la rama `Angie` tenga exactamente lo que hay en la rama `main`.
### 1. Cambiate a la rama que vas a sobrescribir (`Angie`)

```bash
git checkout Angie
```

---

### 2. Resetear el contenido con lo que tiene otra rama (`main`)

```bash
git reset --hard main
```

> Esto hace que tu rama `Angie` tenga el mismo contenido que `main`.

---

### 3. Subir los cambios a GitHub (sobrescribiendo)

```bash
git push origin Angie --force
```

> Esto reemplaza el contenido remoto de `Angie` con el nuevo contenido basado en `main`.

---

### ✅ Resultado:

- `Angie` ahora es una copia exacta de `main`.
    
- Todo lo que estaba antes en `Angie` (tanto local como remoto) se pierde **si no estaba en `main`**.


# En caso de cambiar a una rama sin haber teminado un push
![[git_recuperacion_gustavo - chatgpt version]]
![[traer-archivo-otra-rama]]