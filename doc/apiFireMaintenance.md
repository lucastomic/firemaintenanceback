
# API v1 Endpoints Documentation

Todas las rutas están bajo un prefijo `v1`, indicando que pertenecen a la versión 1 de la API.

## Rutas Protegidas con Middleware `jwt.auth`

Las siguientes rutas requieren un token JWT válido para acceder a ellas:

### GET `/user` - Obtener Usuario Actual
- **Controlador**: `AuthController`
- **Método**: `getUser`
- **Descripción**: Devuelve los detalles del usuario autenticado actualmente.

### GET `/maintenances` - Mantenimientos por Usuario
- **Controlador**: `MaintenanceController`
- **Método**: `getByUser`
- **Descripción**: Obtiene los mantenimientos asociados con el usuario autenticado.

### POST `/equipment/{id}/maintenance` - Crear Mantenimiento
- **Controlador**: `MaintenanceController`
- **Método**: `createMaintenance`
- **Descripción**: Crea un nuevo mantenimiento para el equipo especificado por `{id}`.

### GET `/equipments` - Obtener Todos los Equipos
- **Controlador**: `EquipmentController`
- **Método**: `getAll`
- **Descripción**: Devuelve una lista de todos los equipos.

### GET `/equipment/{id}/maintenances` - Mantenimientos por Equipo
- **Controlador**: `MaintenanceController`
- **Método**: `getByEquipment`
- **Descripción**: Obtiene los mantenimientos asociados con un equipo específico.

### GET `/equipment/{id}/statuses` - Estados por Equipo
- **Controlador**: `StatusController`
- **Método**: `getByEquipment`
- **Descripción**: Devuelve los estados asociados con un equipo específico.

### GET `/equipment/{id}/lastStatus` - Último Estado del Equipo
- **Controlador**: `StatusController`
- **Método**: `getLastStatus`
- **Descripción**: Obtiene el último estado registrado de un equipo específico.

### POST `/equipment/{id}/status` - Añadir Estado a Equipo
- **Controlador**: `StatusController`
- **Método**: `addStatus`
- **Descripción**: Añade un nuevo estado al equipo especificado por `{id}`.

## Rutas Públicas

### POST `/register` - Registro de Usuario
- **Controlador**: `AuthController`
- **Método**: `register`
- **Descripción**: Registra un nuevo usuario en el sistema.

### POST `/login` - Inicio de Sesión
- **Controlador**: `AuthController`
- **Método**: `login`
- **Descripción**: Autentica a un usuario y devuelve un token JWT.

