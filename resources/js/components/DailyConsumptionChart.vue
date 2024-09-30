<template>
    <div class="chart-container">
      <canvas id="waterChart" width="1000" height="500"></canvas>
    </div>
  </template>
  
  <script>
  import { Chart, registerables } from 'chart.js';
  import axios from 'axios';
  
  Chart.register(...registerables);
  
  export default {
    data() {
      return {
        chart: null,
        labels: [],
        data: []
      };
    },
    mounted() {
      this.createChart();
      this.fetchData();
      setInterval(this.fetchData, 20000); // Llamada cada 20 segundos, ajusta según lo necesario
    },
    methods: {
      createChart() {
        const ctx = document.getElementById('waterChart').getContext('2d');
        this.chart = new Chart(ctx, {
          type: 'bar', // Cambia a barra
          data: {
            labels: this.labels,
            datasets: [{
              label: 'Consumo Diario de Agua (L)',
              data: this.data,
              backgroundColor: 'rgba(75, 192, 192, 0.5)',
              borderColor: 'rgba(75, 192, 192, 1)',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              x: {
                title: {
                  display: true,
                  text: 'Fecha'
                }
              },
              y: {
                beginAtZero: true,
                title: {
                  display: true,
                  text: 'Volumen de Consumo (L)'
                }
              }
            }
          }
        });
      },
      fetchData() {
        axios.get('/api/daily-consumption') // Ajusta la URL a tu API
          .then(response => {
            const consumptionData = response.data;
  
            // Obtener las fechas y volúmenes de consumo diario
            this.labels = consumptionData.map(item => item.date);
            this.data = consumptionData.map(item => item.daily_consumption);
  
            // Actualizar el gráfico
            this.chart.data.labels = this.labels;
            this.chart.data.datasets[0].data = this.data;
            this.chart.update();
          })
          .catch(error => {
            console.error("Error al obtener los datos:", error);
          });
      }
    }
  };
  </script>
  
  <style scoped>
  .chart-container {
    position: relative;
    width: 100%;
    height: 500px; /* Altura fija para el gráfico */
    margin: 0 auto;
  }
  
  canvas {
    width: 100% !important;
    height: 100% !important;
  }
  </style>
  