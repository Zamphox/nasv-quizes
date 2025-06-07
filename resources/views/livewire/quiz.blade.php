<div x-data="quizUI()" x-init="init" class="relative min-h-screen overflow-hidden bg-gray-200">

    <!-- Question Section -->
    <div
        x-ref="questionSection"
        x-show="contentVisible"
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-x-0 top-0 bg-white shadow-xl p-6 overflow-auto flex"
        :style="`height: ${questionHeight}px;`"
    >
        <h2 class="text-2xl font-bold text-center m-auto">{{ $question->question }}</h2>
    </div>

    <!-- Answers Section -->
    <div
        x-ref="answersSection"
        x-show="contentVisible"
        x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-x-0 bg-gray-100 p-4 pb-24 overflow-auto"
        :style="`top: ${questionHeight}px; height: ${answersHeight}px; max-height: ${maxAnswersHeight}px;`"
    >
        <div class="grid gap-3" style="grid-template-columns: repeat(2, 1fr);">
            @foreach($shuffledAnswers as $answer)
                <button wire:click="toggleAnswer({{ $answer->id }})"
                        class="p-4 rounded-lg border text-center transition-colors select-none
                {{ $showResults && $answer->is_correct ? 'bg-green-200 border-green-500' : '' }}
                {{ $showResults && $selectedAnswers?->contains('id', $answer->id) && !$answer->is_correct ? 'bg-red-200 border-red-500' : '' }}
                {{ !$showResults && $selectedAnswers?->contains('id', $answer->id) ? 'bg-blue-100 border-blue-300' : '' }}
                {{ !$showResults && !$selectedAnswers?->contains('id', $answer->id) ? 'bg-white border-gray-300' : '' }}"
                        style="{{ $answer->is_big ? 'grid-column: span 2;' : '' }}">
                    {{ $answer->answer }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Submit / Next Button -->
    <div class="fixed bottom-2 left-0 right-0 flex justify-center pointer-events-none z-50">
        @if($showResults)
            <button
                @click.prevent="next()"
                class="pointer-events-auto flex items-center px-5 py-3 bg-green-500 text-white rounded-full
                 shadow-lg hover:bg-green-600 transition-all duration-300 transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="hidden sm:inline"></span>
            </button>
        @else
            <button
                wire:click="checkAnswers"
                @if($selectedAnswers?->count() < $correctAnswersCount) disabled @endif
                class="pointer-events-auto flex items-center gap-2 px-5 py-3 bg-blue-500 text-white rounded-full
                 shadow-lg transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <span>{{ $selectedAnswers ? $selectedAnswers->count() : 0 }}/{{ $correctAnswersCount }}</span>
            </button>
        @endif
    </div>
</div>

<script>
    function quizUI() {
        return {
            windowHeight: window.innerHeight,
            questionHeight: 0,
            answersHeight: 0,
            maxAnswersHeight: 0,

            contentVisible: true,

            init() {
                this.windowHeight = window.innerHeight;
                this.maxAnswersHeight = this.windowHeight * 0.66; // 2/3 max for answers
                this.updateHeights();

                window.addEventListener('resize', () => {
                    this.windowHeight = window.innerHeight;
                    this.maxAnswersHeight = this.windowHeight * 0.66;
                    this.updateHeights();
                });

                Livewire.on('questionUpdated', () => {
                    this.contentVisible = true;
                    this.$nextTick(() => {
                        this.updateHeights();
                    });
                });
            },

            updateHeights() {
                this.$nextTick(() => {
                    const answersSection = this.$refs.answersSection;
                    if (!answersSection) return;

                    // Reset to natural height to measure content height
                    answersSection.style.height = 'auto';

                    // Natural content height of answers (including padding)
                    const naturalAnswersHeight = answersSection.scrollHeight;

                    // Clamp answers height to maxAnswersHeight
                    this.answersHeight = Math.min(naturalAnswersHeight, this.maxAnswersHeight);

                    // Calculate question height as leftover space
                    this.questionHeight = this.windowHeight - this.answersHeight;

                    // Apply clamped height to answersSection
                    answersSection.style.height = `${this.answersHeight}px`;
                });
            },

            next() {
                this.contentVisible = false;
                setTimeout(() => {
                    this.$wire.nextQuestion();
                }, 300);
            },
        }
    }
</script>
