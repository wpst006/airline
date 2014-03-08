CREATE VIEW `schedules_view`
AS 
SELECT schedules.*,flights.name,flights.remark as `flight_remark`,routes.title,routes.`hour`,routes.`min`,routes.`remark` as `route_remark`
FROM schedules
INNER JOIN flights
ON schedules.flight_id=flights.flight_id
INNER JOIN routes
ON schedules.route_id=routes.route_id
ORDER BY schedules.schedule_id;

CREATE VIEW `bookings_view`
AS
SELECT bookingdetails.*,seat_types.title as `seat_title`,schedules_view.*
FROM bookingdetails
INNER JOIN seats
ON bookingdetails.seat_id=seats.seat_id
INNER JOIN schedules_view
ON seats.schedule_id=schedules_view.schedule_id
INNER JOIN seat_types
ON seats.seattype_id=seat_types.seattype_id
ORDER BY bookingdetails.bookingdetail_id;

