<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole 221 - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        header {
            background: linear-gradient(135deg, #38b2ac, #319795);
        }
        
        body::-webkit-scrollbar {
        display: none;
        }
        body {
            -ms-overflow-style: none; 
            scrollbar-width: none; 
        }
        .fc-event {
            cursor: pointer;
        }
        .fc-event-past {
            background-color: green;
            font-weight: bolder;
            border-color: #c3e6cb; 
        }
        .fc-event-future {
            background-color: yellow; 
            font-weight: bolder;
            border-color: #ffeeba; 
        }
        .swal2-popup {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #fff;
            border-radius: 10px;
        }
        .swal2-title {
            color: #319795;
            font-weight: bold;
        }
        .swal2-html-container {
            text-align: left;
            font-size: 1rem;
            color: #4a5568;
        }
        .swal2-confirm {
            background-color: #319795 !important;
            color: #fff !important;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .swal2-confirm:hover {
            background-color: #2c7a7b !important;
        }
    </style>
</head>
<body class="bg-gray-200 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Fixed header -->
        <header class="text-white py-4 shadow-md fixed w-full z-10">
            <div class="container mx-auto text-center">
                <h1 class="text-2xl font-bold">Ecole 221</h1>
                <form action="/logout" method="post">
                    <button class="absolute top-4 right-10 text-2xl font-bold decoration-none text-destructive hover:text-teal-100" type="submit">Deconnexion</button>
                </form>
            </div>
        </header>
        <!-- Main content area -->
        <div class="flex flex-grow pt-16">

            <!-- Sidebar -->
            <aside class="bg-teal-700 text-white w-12 py-6 px-2 fixed lg:relative lg:translate-x-0 lg:w-1/5 shadow-md sidebar">
                <div class="flex flex-col space-y-4">
                    <a href="#" class="py-2 px-4 mx-4 text-center font-semibold transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-teal-600 rounded-lg shadow-lg">Cours</a>
                    <a href="#" class="py-2 px-4 mx-4 text-center font-semibold transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-teal-600 rounded-lg shadow-lg">Sessions</a>   
                </div>
            </aside>
            <!-- Main content -->
            <main class="flex-grow p-6 bg-gray-100 transition-opacity duration-500 fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Etudiant</h3>
                                <p class="text-2xl font-bold text-teal-700">Ndiaga LO</p>
                                <p class="text-sm text-gray-500">Classe Z</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Total heures d'absence</h3>
                                <p class="text-2xl font-bold text-teal-700">2 heures</p>
                                <p class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div class="bg-white shadow-lg rounded-lg p-4 w-full">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Calendrier des cours</h3>
                        <div id="calendar"></div>
                        <div class="flex justify-between items-center px-10 h-10 bg-white rounded-b-lg shadow-lg">
                            <div class="text-sm">
                                <span class="inline-block w-4 h-4 bg-green-600 mr-2 rounded-full"></span>Terminée
                            </div>
                            <div class="text-sm">
                                <span class="inline-block w-4 h-4 bg-red-600 mr-2 rounded-full"></span>Annulée
                            </div>
                            <div class="text-sm">
                                <span class="inline-block w-4 h-4 bg-yellow-200 mr-2 rounded-full"></span>Non effectuée
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sessions = <?php echo json_encode($sessions); ?>;  
            
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },      
                slotMinTime: '08:00:00',
                slotMaxTime: '17:00:00',
                allDaySlot: false,
                height: 'auto',
                events: function(fetchInfo, successCallback, failureCallback) {
                    const now = new Date();
                    const events = sessions.map(session => {
                        const sessionStart = new Date(session.session_date + 'T' + session.session_heure_debut);
                        const isPast = sessionStart < now;

                        return {
                            title: session.cours_libelle + ' - ' + session.module_libelle,
                            start: session.session_date + 'T' + session.session_heure_debut,
                            end: session.session_date + 'T' + session.session_heure_fin,
                            classNames: isPast ? ['fc-event-past'] : ['fc-event-future'],
                            extendedProps: {
                                module: session.module_libelle,
                                classe: session.classe_libelle,
                                salle: session.salle_nom
                            }
                        };
                    });

                    successCallback(events);
                },
                eventClick: function(info) {
                    Swal.fire({
                        title: 'Détails du cours',
                        html: '<strong>Cours:</strong> ' + info.event.title + '<br>' +
                              '<strong>Date:</strong> ' + info.event.start.toLocaleDateString() + '<br>' +
                              '<strong>Module:</strong> ' + info.event.extendedProps.module + '<br>' +
                              '<strong>Classe(s):</strong> ' + info.event.extendedProps.classe + '<br>' +
                              '<strong>Salle:</strong> ' + info.event.extendedProps.salle + '<br>' +
                              '<strong>Heure de début:</strong> ' + info.event.start.toLocaleTimeString() + '<br>' +
                              '<strong>Heure de fin:</strong> ' + info.event.end.toLocaleTimeString(),
                        icon: 'info',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'swal2-popup',
                            title: 'swal2-title',
                            htmlContainer: 'swal2-html-container',
                            confirmButton: 'swal2-confirm'
                        }
                    });
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
