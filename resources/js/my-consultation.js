const APP_URL = `http://127.0.0.1:8000`;
const API_URL_API = `${APP_URL}/api`;

const token = localStorage.getItem("api_token");
const table = document.querySelector("table");

fetch(`${API_URL_API}/all-appointment`, {
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
        let markUp = "";
        let tableHead = "";

        if (data.user === "patient") {
            tableHead = `
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Chief Complaint</th>
                    <th class="px-4 py-2 border-b">RND Name</th>
                    <th class="px-4 py-2 border-b">Consultation Status</th>
                    <th class="px-4 py-2 border-b">Consultation Result</th>
                </tr>
                `;

            data.appointments.forEach((appointment) => {
                let link = `${APP_URL}/${
                    data.user === "patient" ? "" : "dietitian/"
                }consultation/${appointment["appointment_id"]}`;

                let status = "";
                let dietitian_status =
                    appointment["dietitian_name"] === "Pending"
                        ? "pending"
                        : "";

                switch (appointment["consultation_status"]) {
                    case "Approved":
                        status += "approved";
                        break;
                    case "Pending":
                        status += "pending";
                        break;
                    case "Declined":
                        status += "declined";
                        break;
                }

                let template = `<tr>
        <td class="px-4 py-2 text-center border-b"><a class="block py-2 text-white bg-green-800 rounded-md "
                href="${link}">View </a></td>
        <td class="px-4 py-2 border-b text-start">${appointment["chief_complaint"]}</td>
        <td class="px-4 py-2 ${dietitian_status}  border-b">${appointment["dietitian_name"]}</td>
        <td class="px-4 py-2 text-center ${status} border-b">${appointment["consultation_status"]}</td>
        <td class="px-4 py-2 border-b">${appointment["consultation_result"]}</td>
    </tr>`;

                markUp += template;
            });
        } else {
            tableHead = `
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Appointment Date</th>
                    <th class="px-4 py-2 border-b">Chief Complaint</th>
                    <th class="px-4 py-2 border-b">Patient Name</th>
                    <th class="px-4 py-2 border-b">Gender</th>
                </tr>
                `;

            data.appointments.forEach((appointment) => {
                let link = `${APP_URL}/${
                    data.user === "patient" ? "" : "dietitian/"
                }consultation/${appointment["appointment_id"]}`;

                let personal = appointment.personal_information;

                let template = `<tr>
            <td class="px-4 py-2 text-center border-b"><a class="block py-2 text-white bg-green-800 rounded-md "
                    href="${link}">View </a></td>
            <td class="px-4 py-2 border-b ">${appointment["appointment_date"]}</td>
            <td class="px-4 py-2 border-b text-start">${appointment["chief_complaint"]}</td>
            <td class="px-4 py-2 border-b">${personal.first_name} ${personal.last_name}</td>
            <td class="px-4 py-2 border-b">${personal.gender}</td>
        </tr>`;

                markUp += template;
            });
        }

        table.querySelector("thead").innerHTML = tableHead;
        table.querySelector("tbody").innerHTML = markUp;
    })
    .catch((error) => {
        console.error("Error:", error);
    });
