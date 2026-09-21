<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
    xmlns:html="http://www.w3.org/TR/REC-html40"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
            <head>
                <title>XML Sitemap — Pokemon Calculator Hub</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style type="text/css">
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                        color: #1E293B;
                        background: #F8FAFC;
                        margin: 0;
                        padding: 30px;
                    }
                    .container {
                        max-width: 1100px;
                        margin: 0 auto;
                        background: #FFFFFF;
                        border-radius: 10px;
                        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
                        padding: 32px;
                        border: 1px solid #E2E8F0;
                    }
                    h1 {
                        font-size: 1.6rem;
                        font-weight: 800;
                        color: #0F172A;
                        margin-bottom: 8px;
                    }
                    p {
                        color: #64748B;
                        font-size: 0.95rem;
                        margin-bottom: 24px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 0.9rem;
                    }
                    th {
                        background: #F1F5F9;
                        padding: 12px 16px;
                        text-align: left;
                        font-weight: 700;
                        color: #475569;
                        border-bottom: 2px solid #CBD5E1;
                    }
                    td {
                        padding: 12px 16px;
                        border-bottom: 1px solid #E2E8F0;
                    }
                    tr:hover td {
                        background: #F8FAFC;
                    }
                    a {
                        color: #2563EB;
                        text-decoration: none;
                        font-weight: 500;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                    .badge {
                        display: inline-block;
                        padding: 2px 8px;
                        border-radius: 4px;
                        font-size: 0.8rem;
                        font-weight: 600;
                        background: #E0E7FF;
                        color: #3730A3;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Pokemon Calculator Hub XML Sitemap</h1>
                    <p>This dynamic XML sitemap is generated automatically for search engines (Google, Bing, Yandex, DuckDuckGo). It contains <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/> indexed URLs.</p>
                    <table>
                        <thead>
                            <tr>
                                <th>URL Location</th>
                                <th>Change Frequency</th>
                                <th>Priority</th>
                                <th>Last Modified</th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:for-each select="sitemap:urlset/sitemap:url">
                                <tr>
                                    <td>
                                        <a href="{sitemap:loc}">
                                            <xsl:value-of select="sitemap:loc"/>
                                        </a>
                                    </td>
                                    <td>
                                        <xsl:value-of select="sitemap:changefreq"/>
                                    </td>
                                    <td>
                                        <span class="badge">
                                            <xsl:value-of select="sitemap:priority"/>
                                        </span>
                                    </td>
                                    <td style="color:#64748B;">
                                        <xsl:value-of select="sitemap:lastmod"/>
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
