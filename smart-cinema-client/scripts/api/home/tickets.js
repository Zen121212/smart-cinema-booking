import axios from "axios";

export async function getUserTickets(userId) {
  try {
    const response = await axios.get(
      `http://localhost/FSE-2025/smart-cinema-booking/smart-cinema-server/controllers/ticketing/index.php?id=${userId}`
    );

    let tickets = [];

    if (response.data.id) {
      tickets = [response.data];
    } else if (response.data.booking) {
      tickets = response.data.booking;
    }

    return tickets;
  } catch (error) {
    console.error("Error fetching tickets:", error);
    throw new Error("Failed to load tickets.");
  }
}
