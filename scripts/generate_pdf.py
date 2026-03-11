from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer

input_md = 'docs/cahier_de_charges_quisolideo.md'
output_pdf = 'docs/Cahier_de_charges_Quisolideo.pdf'

# Read markdown and convert to simple paragraphs
with open(input_md, 'r', encoding='utf-8') as f:
    lines = f.read().splitlines()

styles = getSampleStyleSheet()
normal = styles['Normal']
heading = ParagraphStyle('Heading', parent=styles['Heading1'], spaceAfter=12)
subheading = ParagraphStyle('SubHeading', parent=styles['Heading2'], spaceAfter=8)

story = []
for line in lines:
    if line.startswith('# '):
        story.append(Paragraph(line[2:].strip(), heading))
    elif line.startswith('## '):
        story.append(Paragraph(line[3:].strip(), subheading))
    elif line.startswith('### '):
        story.append(Paragraph(line[4:].strip(), styles['Heading3']))
    elif line.strip() == '---':
        story.append(Spacer(1, 12))
    elif line.strip() == '':
        story.append(Spacer(1, 6))
    else:
        # escape any ampersands
        text = line.replace('&', '&amp;')
        story.append(Paragraph(text, normal))

story.insert(0, Spacer(1,12))

# Build PDF
doc = SimpleDocTemplate(output_pdf, pagesize=A4, rightMargin=40, leftMargin=40, topMargin=60, bottomMargin=40)
doc.build(story)
print('PDF generated at', output_pdf)
