# Sistema de Monitoreo de Agua con IoT y Machine Learning

## Demo y Presentación
- **Demo en vivo:** [Demo de Sistema de Monitoreo de Agua](https://sysmonwa.techhyoinnovation.com/)
- **Video de presentación:** [Mira el video de presentación del proyecto](https://drive.google.com/file/d/1nh6LUGIFkCmo6l062ByvVykQBWh_0jfN/view?usp=sharing)

Un sistema integral para monitorear el **consumo**, **nivel** y **calidad** del agua en tanques, diseñado para su implementación en hogares o instituciones. Este proyecto utiliza tecnologías de **Internet de las Cosas (IoT)** y **Machine Learning** para ofrecer monitoreo en tiempo real, alertas preventivas y predicciones sobre el estado del agua, promoviendo una gestión eficiente y sostenible del recurso.

## Descripción del Proyecto

Con más de 2 mil millones de personas en el mundo sin acceso seguro a agua potable, y una creciente crisis de escasez de agua, este sistema responde a una necesidad crítica: asegurar que el agua en hogares e instituciones sea segura, suficiente y bien gestionada. Este prototipo permite a los usuarios:
- **Controlar el consumo** de agua para evitar desperdicios.
- **Monitorear el nivel** de agua en el tanque, previniendo escasez o sobrellenado.
- **Verificar la calidad** del agua en tiempo real, identificando posibles riesgos de salud.
- **Recibir alertas** automáticas para tomar medidas oportunas.
- **Visualizar predicciones** de consumo y calidad basadas en patrones históricos para anticipar la demanda.

## Características Principales

1. ### Monitoreo del Consumo de Agua
   - **Visualización en tiempo real** del volumen de agua consumido.
   - **Historial de consumo** para analizar tendencias y facilitar la planificación de uso.
   - **Alertas** en caso de consumo excesivo o irregular, permitiendo una gestión proactiva.

2. ### Monitoreo del Nivel de Agua
   - **Monitoreo constante** del nivel en el tanque para asegurar disponibilidad.
   - **Alertas automáticas** cuando el nivel de agua está en un umbral crítico (muy bajo o alto).
   - **Predicción del tiempo restante** hasta que el tanque se vacíe o necesite ser llenado.

3. ### Monitoreo de la Calidad del Agua
   - **Detección de parámetros clave** como el pH y la turbidez, esenciales para evaluar la potabilidad del agua.
   - **Alertas de calidad** que notifican cuando el agua no cumple con los estándares.
   - **Registro histórico** de la calidad del agua para un análisis a largo plazo.

4. ### Predicciones Basadas en Machine Learning
   - **Modelos de Machine Learning** entrenados para analizar patrones históricos y prever el consumo, nivel y calidad.
   - **Alertas semanales y recomendaciones** para mejorar la gestión del agua.

## Tecnologías Utilizadas

- **Laravel**: Framework PHP para el desarrollo de la aplicación web.
- **IoT**: Sensores de nivel, flujo y calidad de agua conectados a placas ESP32 para la captura de datos en tiempo real.
- **Machine Learning**: Google Colab para el entrenamiento y desarrollo de modelos de predicción.
- **MySQL**: Base de datos relacional para el almacenamiento de datos históricos.
- **Apache**: Servidor web para el despliegue de la aplicación.
- **Git**: Control de versiones para gestionar el desarrollo colaborativo del proyecto.

## Instalación

### Requisitos

#### Hardware
- **Sensores de agua**:
  - Sensor de flujo para medir el consumo de agua.
  - Sensor de nivel para controlar la cantidad de agua en el tanque.
  - Sensores de calidad (pH y turbidez) para evaluar la potabilidad.
- **Placa ESP32**: Conexión de sensores y transmisión de datos.

#### Software
- [XAMPP](https://www.apachefriends.org/index.html): Para un entorno de desarrollo local con Apache, PHP y MySQL.
- [Composer](https://getcomposer.org/): Administrador de dependencias para PHP.
- [Google Colab](https://colab.research.google.com/): Plataforma para el desarrollo y entrenamiento de modelos de Machine Learning.

### Paso 1: Clonar el Repositorio
```bash
git clone git@github.com:i1920929/sysmonwa.git
cd sysmonwa
