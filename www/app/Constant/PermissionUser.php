<?php

namespace App\Constant;

enum PermissionUser: string
{
    case DashboardIndex = 'dashboard_index';
        // MASTER DATA HEAD
    case Masterdata = 'masterdata';
        // MASTER DATA
    case AgendaIndex = 'agenda_index';
    case AgendaCreate = 'agenda_create';
    case AgendaShow = 'agenda_show';
    case AgendaUpdate = 'agenda_update';
    case AgendaDestroy = 'agenda_destroy';
    case AgendaStore = 'agenda_store';
    case AgendaCreateQuickModeStore = 'agenda_create_quick_mode';
    case AgendaStoreQuickModeStore = 'agenda_store_quick_mode';
    case MasjidIndex = 'masjid_index';
    case MasjidCreate = 'masjid_create';
    case MasjidShow = 'masjid_show';
    case MasjidUpdate = 'masjid_update';
    case MasjidDestroy = 'masjid_destroy';
    case MasjidStore = 'masjid_store';
    case CatatanSuratIndex = 'catatan_surat_index';
    case CatatanSuratCreate = 'catatan_surat_create';
    case CatatanSuratShow = 'catatan_surat_show';
    case CatatanSuratUpdate = 'catatan_surat_update';
    case CatatanSuratDestroy = 'catatan_surat_destroy';
    case CatatanSuratStore = 'catatan_surat_store';
    case TtdIndex = 'ttd_index';
    case TtdCreate = 'ttd_create';
    case TtdShow = 'ttd_show';
    case TtdUpdate = 'ttd_update';
    case TtdDestroy = 'ttd_destroy';
    case TtdStore = 'ttd_store';
    case CapIndex = 'cap_index';
    case CapCreate = 'cap_create';
    case CapShow = 'cap_show';
    case CapUpdate = 'cap_update';
    case CapDestroy = 'cap_destroy';
    case CapStore = 'cap_store';
    case UstadzIndex = 'ustadz_index';
    case UstadzCreate = 'ustadz_create';
    case UstadzShow = 'ustadz_show';
    case UstadzUpdate = 'ustadz_update';
    case UstadzDestroy = 'ustadz_destroy';
    case UstadzStore = 'ustadz_store';
        // WORKSPACE HEAD
    case Workspace = 'workspace';
        // WORKSPACE
    case TakjilIndex = 'takjil_index';
    case TakjilCreate = 'takjil_create';
    case TakjilShow = 'takjil_show';
    case TakjilUpdate = 'takjil_update';
    case TakjilDestroy = 'takjil_destroy';
    case TakjilStore = 'takjil_store';
    case KultumIndex = 'kultum_index';
    case KultumCreate = 'kultum_create';
    case KultumShow = 'kultum_show';
    case KultumUpdate = 'kultum_update';
    case KultumDestroy = 'kultum_destroy';
    case KultumStore = 'kultum_store';
    case ExportPdfIndex = 'exportpdf_index';
    case ExportPdfDownload = 'exportpdf_download';
    case ExportPdfUstadzDownload = 'exportpdf_ustadz_download';
}
