const APP_URL = `http://127.0.0.1:8000`;
const API_URL_API = `${APP_URL}/api`;

const token = localStorage.getItem("api_token");
const table = document.querySelector("table");

fetch(`${API_URL_API}/all-pending-appointment`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
    },
})
    // Parse JSON response
    .then((response) => response.json())
    // successs
    .then((data) => {
        console.log(data);

        let markUp = "";

        data.appointments.forEach((appointment) => {
            let link = `${APP_URL}/${
                data.user === "patient" ? "" : "dietitian/"
            }consultation/${appointment["appointment_id"]}`;

            let template = `<tr>
                                <td class="px-4 py-2 text-center border-b"><a class="block py-2 text-white bg-green-800 rounded-md " href="${link}">View </a></td>
                                <td class="px-4 py-2 border-b">${appointment["chief_complaint"]}</td>
                                <td class="px-4 py-2 border-b">${appointment["dietitian_name"]}</td>
                                <td class="px-4 py-2 text-center text-green-600 border-b">${appointment["consultation_status"]}</td>
                                <td class="px-4 py-2 border-b">${appointment["consultation_result"]}</td>
                            </tr>`;

            markUp += template;
        });

        table.querySelector("tbody").innerHTML = markUp;
    })
    .catch((error) => {
        console.error("Error:", error);
    });
