const APP_URL = `http://127.0.0.1:8000`;
const API_URL_API = `${APP_URL}/api`;

let table = document.querySelector("table");
const token = localStorage.getItem("api_token");

table.addEventListener("click", function (e) {
    // approve btn
    if (e.target.classList.contains("approve-btn")) {
        let id = e.target.closest(".appointment").getAttribute("data-id");

        let data = {
            step: 3,
            status: "approved",
            dietitian_id: 2,
            id: id,
        };

        fetch(`${API_URL_API}/appointment/${id}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify(data),
        })
            // Parse JSON response
            .then((response) => response.json())
            // successs
            .then((data) => {
                console.log(data);
                window.location = `${APP_URL}/dietitian/consultation/${id}`;
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }

    // decline btn
    if (e.target.classList.contains("decline-btn")) {
        let id = e.target.closest(".appointment").getAttribute("data-id");

        let data = {
            status: "declined",
            dietitian_id: "declined",
            id: id,
        };

        fetch(`${API_URL_API}/appointment/${id}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify(data),
        })
            // Parse JSON response
            .then((response) => response.json())
            // successs
            .then((data) => {
                window.location.reload();
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }
});

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

            let template = ` <tr class=" appointment" data-id="${appointment["appointment_id"]}">
            <td class="px-4 py-2 border-b">${appointment["appointment_date"]}</td>
            <td class="px-4 py-2 border-b">${appointment["chief_complaint"]}</td>
                                <td class="px-4 py-2 border-b">${appointment["age"]}</td>
                                <td class="px-4 py-2 capitalize border-b">${appointment["gender"]}</td>
                                <td class="flex items-center justify-center gap-5 px-4 py-2 border-b">
                                    <div
                                        class="px-5 py-2 text-white bg-green-500 rounded-md cursor-pointer approve-btn">
                                        Approve</div>
                                    <div class="px-5 py-2 text-white bg-red-500 rounded-md cursor-pointer decline-btn">
                                        Decline</div>
                                </td>
                            </tr>`;

            markUp += template;
        });

        table.querySelector("tbody").innerHTML = markUp;
    })
    .catch((error) => {
        console.error("Error:", error);
    });
