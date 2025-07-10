function loadMajorsData() {
  const ctx = document.getElementById("comparisonChart")?.getContext("2d");
  const tableBody = document.querySelector("#dataTable tbody");

  // التأكد من وجود العناصر المطلوبة
  if (!ctx || !tableBody) return;

  // استرجاع البيانات من التخزين المحلي
  let majorsData = JSON.parse(localStorage.getItem("majorsData")) || [];

  // تفريغ محتوى الجدول
  tableBody.innerHTML = "";

  // ملء الجدول بالبيانات
  majorsData.forEach(item => {
    const row = `<tr><td>${item["التخصص"]}</td><td>${item["المعدل"]}</td></tr>`;
    tableBody.innerHTML += row;
  });

  // إعداد البيانات للرسم البياني
  const labels = majorsData.map(item => item["التخصص"]);
  const data = majorsData.map(item => item["المعدل"]);

  // حذف الرسم البياني السابق إن وجد
  if (window.comparisonChart) {
    window.comparisonChart.destroy();
  }

  // إنشاء الرسم البياني الجديد
  window.comparisonChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: labels,
      datasets: [{
        label: "المعدل التراكمي",
        data: data,
        backgroundColor: "#3b82f6"
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}

// دالة لتحميل الرسم كصورة
function downloadChart() {
  const canvas = document.getElementById("comparisonChart");
  const image = canvas.toDataURL("image/png");
  const link = document.createElement("a");
  link.href = image;
  link.download = "تقرير_التخصصات.png";
  link.click();
}