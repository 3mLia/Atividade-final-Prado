<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Novo Agendamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-8">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-900/50 border border-red-500 text-red-200 p-4 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Seleção de Serviço --}}
                    <div>
                        <label class="block text-barber-gold font-bold mb-2">Serviço</label>
                        <select name="service_id" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Seleção de Data --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-barber-gold font-bold mb-2">Dia</label>
                            <select name="day" id="day-select" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-barber-gold font-bold mb-2">Mês</label>
                            <select name="month" id="month-select" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    {{-- Seleção de Hora (Será preenchida pelo Javascript) --}}
                    <div>
                        <label class="block text-barber-gold font-bold mb-2">Horário Disponível</label>
                        <select name="hour" id="hour-select" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                            <option value="" disabled selected>Carregando horários...</option>
                        </select>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="w-full bg-barber-gold text-barber-dark py-3 rounded-md font-bold hover:bg-amber-600 transition uppercase tracking-wider">
                            Confirmar Agendamento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script de Validação Dinâmica de Horários --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const daySelect = document.getElementById('day-select');
            const monthSelect = document.getElementById('month-select');
            const hourSelect = document.getElementById('hour-select');
            const currentYear = new Date().getFullYear();

            // Gera todos os horários possíveis (09:00 até 18:00)
            const allHours = [];
            for(let i = 9; i <= 18; i++) {
                let hourStr = String(i).padStart(2, '0');
                allHours.push(`${hourStr}:00`);
                if (i !== 18) {
                    allHours.push(`${hourStr}:30`);
                }
            }

            function checkAvailability() {
                const day = daySelect.value;
                const month = monthSelect.value;

                if(!day || !month) return;

                // Mostra que está carregando enquanto consulta o servidor
                hourSelect.innerHTML = '<option value="" disabled selected>Buscando horários disponíveis...</option>';

                const dateString = `${currentYear}-${month}-${day}`;

                // Faz a consulta na rota que criamos no passo anterior
                fetch(`/appointments/check-availability?date=${dateString}`)
                    .then(response => response.json())
                    .then(data => {
                        const occupiedTimes = data.occupiedTimes || [];
                        const now = new Date();
                        const isToday = (now.getFullYear() === currentYear && (now.getMonth() + 1) === parseInt(month) && now.getDate() === parseInt(day));

                        // Limpa a lista para colocar só os horários livres
                        hourSelect.innerHTML = '<option value="" disabled selected>Selecione um horário</option>';
                        let hasAvailable = false;

                        // Passa por todos os horários do dia
                        allHours.forEach(timeValue => {
                            let isAvailable = true;

                            // Regra 1: Se o horário já veio ocupado do banco de dados
                            if (occupiedTimes.includes(timeValue)) {
                                isAvailable = false;
                            } 
                            // Regra 2: Se for hoje, bloqueia os horários que já passaram
                            else if (isToday) {
                                const [hours, minutes] = timeValue.split(':');
                                const optionTime = new Date();
                                optionTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);
                                if (optionTime <= now) {
                                    isAvailable = false;
                                }
                            }

                            // Só cria a opção na tela se o horário passou pelos testes
                            if (isAvailable) {
                                hasAvailable = true;
                                const option = document.createElement('option');
                                option.value = timeValue;
                                option.textContent = timeValue;
                                hourSelect.appendChild(option);
                            }
                        });

                        // Mensagem de aviso caso todos os horários estejam ocupados/passados
                        if (!hasAvailable) {
                            hourSelect.innerHTML = '<option value="" disabled selected>Nenhum horário disponível para este dia.</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar disponibilidade:', error);
                        hourSelect.innerHTML = '<option value="" disabled selected>Erro ao carregar. Tente novamente.</option>';
                    });
            }

            // Ouve as mudanças quando o usuário troca o Dia ou Mês
            daySelect.addEventListener('change', checkAvailability);
            monthSelect.addEventListener('change', checkAvailability);

            // Marca o dia e mês de hoje por padrão ao abrir a página
            const today = new Date();
            const todayDay = String(today.getDate()).padStart(2, '0');
            const todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            
            if(Array.from(daySelect.options).some(opt => opt.value === todayDay)) daySelect.value = todayDay;
            if(Array.from(monthSelect.options).some(opt => opt.value === todayMonth)) monthSelect.value = todayMonth;

            // Roda a verificação pela primeira vez
            checkAvailability();
        });
    </script>
</x-app-layout>