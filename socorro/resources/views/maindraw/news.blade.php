    <!-- News Section -->
    <section id="noticias" class="news">
        <div class="reveal container">
            <div class="section-header">
                <h2 class="section-title text-dark">Últimas Noticias</h2>
                <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">
                <p class="section-subtitle">Mantente informado sobre nuestras operaciones y novedades del rescate de montaña</p>
            </div>
            <div id="newsContainer">
                <div class="news-grid">
                    @foreach($news as $item)
                        <article class="news-card @if($item->featured) featured @endif">
                            <div class="news-image">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="img-fluid">
                                @if($item->featured)
                                    <div class="news-badge">Destacada</div>
                                @endif
                            </div>
                            <div class="news-content">
                                <div class="news-meta">
                                    <span class="news-date">{{ $item->created_at->format('d M Y') }}</span>
                                    <span class="news-category">{{ $item->category->name }}</span>
                                </div>
                                <h3>{{ $item->title }}</h3>
                                {{ substr(strip_tags($item->description), 0, 150) }}{{ strlen(strip_tags($item->description)) > 150 ? '...' : '' }}
                                <a href="#"  onclick="showNews({{ $item->id }})" class="news-link">Leer más →</a>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="pagination">
                    <div class="news-pagination-bar">
                        <div class="news-pagination-summary">
                            Mostrando {{ $news->firstItem() ?? 0 }} a {{ $news->lastItem() ?? 0 }} de {{ $news->total() }} resultados
                        </div>
                        {{ $news->onEachSide(1)->links('pagination.news') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
