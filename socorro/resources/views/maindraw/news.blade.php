    <!-- News Section -->
    <section id="noticias" class="news">
        <div class="reveal container">
            <div class="section-header">
                <span class="news-category">Actualidad institucional</span>
                <h2 class="section-title text-dark mt-3">Últimas noticias</h2>
                <p class="section-subtitle">Operaciones, prevención y novedades del rescate de montaña en Chile.</p>
            </div>
            <div id="newsContainer">
                <div class="news-grid">
                    @foreach($news as $item)
                        <article class="news-card @if($item->featured) featured @endif">
                            <div class="news-image">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" loading="lazy">
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
                                <p class="news-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 155) }}</p>
                                <a href="#" onclick="showNews({{ $item->id }}); return false;" class="news-link" data-no-loading>
                                    Leer noticia <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                </a>
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
